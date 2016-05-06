<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Location_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function create_location($company_id, $name, $street, $zipcode, $city, $country_id, $phone, $fax, $email, $website)
	{
		$address_id = $this->get_address_id($street, $zipcode, $city, $country_id);
		
		if ($address_id <= 0) {
			$this->db->set('address_street', $street);
			$this->db->set('address_zipcode', $zipcode);
			$this->db->set('address_city', $city);
			$this->db->set('country_id', $country_id);

			$this->db->insert('Address');

			$address_id = $this->db->insert_id();
		}

		$this->db->set('company_id', $company_id);
		$this->db->set('address_id', $address_id);
		$this->db->set('location_name', $name);
		$this->db->set('location_phone', $phone);
		$this->db->set('location_fax', $fax);
		$this->db->set('location_email', $email);
		$this->db->set('location_website', $website);

		$this->db->insert('Location');

		return $this->db->insert_id();
	}
	
	function create_location_short($name, $street, $zipcode, $city, $country_id)
	{
		$address_id = $this->get_address_id($street, $zipcode, $city, $country_id);
		
		if ($address_id <= 0) {
			$this->db->set('address_street', $street);
			$this->db->set('address_zipcode', $zipcode);
			$this->db->set('address_city', $city);
			$this->db->set('country_id', $country_id);

			$this->db->insert('Address');

			$address_id = $this->db->insert_id();
		}

		$this->db->set('address_id', $address_id);
		$this->db->set('location_name', $name);

		$this->db->insert('Location');

		return $this->db->insert_id();
	}

	function edit_location($location_id, $data)
	{
		$address_id = $this->db->query('
			SELECT address_id 
			FROM Location 
			WHERE location_id = ?
		', array($location_id))->first_row()->address_id;

		if ($this->edit_address($address_id, $data)) {
			if (array_key_exists('name', $data) && !is_null($data['name'])) {
				$this->db->set('location_name', $data['name']);
			}

			if (array_key_exists('phone', $data)) {
				$this->db->set('location_phone', $data['phone']);
			}

			if (array_key_exists('fax', $data)) {
				$this->db->set('location_fax', $data['fax']);
			}

			if (array_key_exists('email', $data)) {
				$this->db->set('location_email', $data['email']);
			}

			if (array_key_exists('website', $data)) {
				$this->db->set('location_website', $data['website']);
			}

			$this->db->where('location_id', $location_id);
			return $this->db->update('Location');
		}

		return false;
	}
	
	function add_company_id_to_location($p_location_id, $p_company_id)
	{
		$this->db->set('company_id', $p_company_id);
		$this->db->where('location_id', $p_location_id);
		return $this->db->update('Location');
	}

	function edit_address($address_id, $data) {
		if (array_key_exists('street', $data) && !is_null($data['street'])) {
			$this->db->set('address_street', $data['street']);
		}

		if (array_key_exists('zipcode', $data) && !is_null($data['zipcode'])) {
			$this->db->set('address_zipcode', $data['zipcode']);
		}

		if (array_key_exists('city', $data) && !is_null($data['city'])) {
			$this->db->set('address_city', $data['city']);
		}

		if (array_key_exists('country', $data) && !is_null($data['country'])) {
			$this->db->set('country_id', $data['country']);
		}

		$this->db->where('address_id', $address_id);
		return $this->db->update('Address');
	}

	function delete_location($location_id)
	{
		$this->Job->delete_jobs_at_location($location_id);

		$this->db->where('location_id', $location_id);
		return $this->db->delete('Location');
	}

	function get_countries()
	{
		return $this->db->query('
			SELECT * 
			FROM Country
			ORDER BY country_name
		');
	}

	function get_location($p_command = '', $p_data = '')
	{
		$type = preg_split("[:]", $p_command);

		if ($p_command != '') {
			switch ($type[0]) {
				case 'filter': 
					switch ($type[1]) {
						case 'id': 
							$query = $this->db->query('
								SELECT * 
								FROM Location 
								INNER JOIN Address USING (address_id) 
								INNER JOIN Country USING (country_id) 
								WHERE location_id = ?
							', array($p_data));
						break;

						case 'company': 
							$query = $this->db->query('
								SELECT * 
								FROM Location 
								INNER JOIN Address USING (address_id) 
								INNER JOIN Country USING (country_id) 
								INNER JOIN Company Using (company_id) 
								WHERE company_id = ?
							', array($p_data));
						break;
						
						case 'notmainlocation': 
							$query = $this->db->query('
								SELECT * 
								FROM Location 
								INNER JOIN Address USING (address_id) 
								INNER JOIN Country USING (country_id) 
								INNER JOIN Company Using (company_id) 
								WHERE company_id = ? 
								AND location_id != company_main_location
							', array($p_data));
						break;
					}
				break;

				case 'all':
					$query = $this->db->query('
						SELECT * 
						FROM Location
						INNER JOIN Address USING (address_id)
						INNER JOIN Country USING (country_id)
					');
				break;
			}

			return $query;
		}

		return null;
	}
	
	function get_address_id($street, $zipcode, $city, $country_id)
	{
		$query = $this->db->query('
			SELECT address_id 
			FROM Address 
			WHERE address_street = ? 
				AND address_zipcode = ? 
				AND address_city = ? 
				AND country_id = ?
		', array($street, $zipcode, $city, $country_id));

		if ($query->num_rows() > 0) {
			return $query->first_row()->address_id;
		}
		
		return 0;
	}
}
?>