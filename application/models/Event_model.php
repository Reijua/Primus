<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function create_event($name, $street, $zipcode, $city, $country_id, $description, $start_date, $end_date, $leader_id, $type_id, $membercount)
	{
		$address_id = $this->Location->get_address_id($street, $zipcode, $city, $country_id);
		
		if ($address_id <= 0) {
			$this->db->set('address_street', $street);
			$this->db->set('address_zipcode', $zipcode);
			$this->db->set('address_city', $city);
			$this->db->set('country_id', $country_id);

			$this->db->insert('Address');

			$address_id = $this->db->insert_id();
		}

		$this->db->set('event_name', $name);
		$this->db->set('event_description', $description);
		$this->db->set('event_start_date', $start_date);
		if($end_date != NULL)
			$this->db->set('event_end_date', $end_date);
		$this->db->set('address_id', $address_id);
		$this->db->set('leader_id', $leader_id);
		$this->db->set('eventtype_id', $type_id);
		$this->db->set('event_max_member', $membercount);

		$this->db->insert('Event');

		return $this->db->insert_id();
	}
	
	function create_eventtype($name)
	{
		$this->db->set('eventtype_name', $name);
		$this->db->insert('EventType');
		return $this->db->insert_id();
	}

	function get_upcoming_events()
	{
		return $this->db->query('
			SELECT * 
			FROM Event 
			INNER JOIN EventType USING (eventtype_id)
			INNER JOIN Address USING (address_id)
			INNER JOIN Country USING (country_id)
			WHERE event_start_date BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 6 MONTH)
			ORDER BY event_start_date ASC
		');
	}
	
	function get_events()
	{
		return $this->db->query("SELECT * FROM Event 
		INNER JOIN EventType USING(eventtype_id) 
		INNER JOIN Address USING(address_id)");
	}
	
	function create_event_type($name)
	{
		$this->db->set('eventtype_name', $name);
		$this->db->insert('EventType');
		return $this->db->insert_id();
	}
	
	function get_event_types()
	{
		return $this->db->query("SELECT * FROM EventType");
	}
	
	function get_max_member($event_id)
	{
		return $this->db->query("SELECT event_max_member FROM Event WHERE event_id = ?", array($event_id))->first_row()->event_max_member;
	}

	function is_participant($event_id, $member_id)
	{
		return $this->db->query("SELECT * FROM EventMember 
		WHERE event_id = ? AND member_id = ?", array($event_id, $member_id))->num_rows() >= 1;
	}

	function remove_participant($event_id, $member_id)
	{
		$this->db->where('event_id', $event_id);
		$this->db->where('member_id', $member_id);

		return $this->db->delete('EventMember');
	}

	function add_participant($event_id, $member_id)
	{
		$this->db->set('event_id', $event_id);
		$this->db->set('member_id', $member_id);

		$this->db->insert('EventMember');
		return $this->db->insert_id();
	}
	
	function get_participants($event_id)
	{
		return $this->db->query("SELECT * FROM EventMember 
		INNER JOIN Member USING(member_id) 
		INNER JOIN User ON(member_id = user_id) 
		INNER JOIN Gender USING(gender_id)
		INNER JOIN Event USING(event_id) 
		WHERE event_id = ?", array($event_id));
	}

	function get_participant_count($event_id)
	{
		return $this->db->query("SELECT COUNT(member_id) count FROM EventMember 
		WHERE event_id = ?", array($event_id))->first_row()->count;
	}
	
	function get_event_with_id($event_id)
	{
		return $this->db->query("SELECT * FROM Event 
		INNER JOIN EventType USING(eventtype_id) 
		INNER JOIN Address USING(address_id) 
		INNER JOIN Country USING(country_id)
		WHERE event_id = ?", array($event_id));
	}
	
	function edit_event($event_id, $data)
	{
		//Check if new address
		if(array_key_exists('street', $data) && !is_null($data['street']) &&
		array_key_exists('zipcode', $data) && !is_null($data['zipcode']) &&
		array_key_exists('city', $data) && !is_null($data['city']) &&
		array_key_exists('country', $data) && !is_null($data['country']))
		{
			$address_id = $this->Location->get_address_id($data['street'], $data['zipcode'], $data['city'], $data['country']);
			
			if ($address_id <= 0) {
				$this->db->set('address_street', $data['street']);
				$this->db->set('address_zipcode', $data['zipcode']);
				$this->db->set('address_city', $data['city']);
				$this->db->set('country_id', $data['country']);

				$this->db->insert('Address');

				$address_id = $this->db->insert_id();
			}
		}
		
		if (array_key_exists('name', $data) && !is_null($data['name'])) 
		{
			$this->db->set('event_name', $data['name']);
		}

		if (array_key_exists('description', $data) && !is_null($data['description'])) 
		{
			$this->db->set('event_description', $data['description']);
		}

		if (array_key_exists('startdate', $data) && !is_null($data['startdate'])) 
		{
			$this->db->set('event_start_date', $data['startdate']);
		}
		
		if (array_key_exists('enddate', $data) && !is_null($data['enddate'])) 
		{
			$this->db->set('event_end_date', $data['enddate']);
		}
		
		if(isset($address_id) && !is_null($address_id))
		{
			$this->db->set('address_id', $address_id);
		}
		
		if (array_key_exists('leader', $data) && !is_null($data['leader'])) 
		{
			$this->db->set('leader_id', $data['leader']);
		}
		
		if (array_key_exists('eventtype', $data) && !is_null($data['eventtype'])) 
		{
			$this->db->set('eventtype_id', $data['eventtype']);
		}
		
		if (array_key_exists('maxmember', $data) && !is_null($data['maxmember'])) 
		{
			$this->db->set('event_max_member', $data['maxmember']);
		}

		$this->db->where('event_id', $event_id);
		return $this->db->update('Event');
	}
	
	function delete_event($event_id)
	{
		$this->db->where('event_id', $event_id);
		return $this->db->delete('Event');
	}
}
?>