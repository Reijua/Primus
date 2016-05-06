<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function write_message($sender_id, $recipient_id, $subject, $message)
	{
		$this->db->set('message_sender_id', $sender_id);
		$this->db->set('message_recipient_id', $recipient_id);
		$this->db->set('message_date_sent', 'NOW()', false); // false => Don't escape the NOW() function
		$this->db->set('message_subject', $subject);
		$this->db->set('message_text', $message);

		$this->db->insert('Message');

		return $this->db->insert_id();
	}

	function count_unread_messages($recipient_id)
	{
		return $this->db->query('
			SELECT COUNT(message_id) AS count
			FROM Message 
			WHERE message_recipient_id = ? AND message_read = 0
		', array($recipient_id))->first_row()->count;
	}

	function set_read_message($message_id)
	{
		$this->db->set('message_read', 1);

		$this->db->where('message_id', $message_id);
		return $this->db->update('Message');
	}

	function get_message($p_command = '', $p_data = '')
	{
		$type = preg_split("[:]", $p_command);

		if ($p_command != '') {
			switch ($type[0]) {
				case 'filter': 
					switch ($type[1]) {
						case 'id': 
							$query = $this->db->query('
								SELECT *
								FROM Message 
								WHERE message_id = ?
								ORDER BY message_date_sent DESC
							', array($p_data));
						break;

						case 'sender': 
							$query = $this->db->query('
								SELECT *
								FROM Message 
								WHERE message_sender_id = ?
								ORDER BY message_date_sent DESC
							', array($p_data));
						break;

						case 'recipient': 
							$query = $this->db->query('
								SELECT *
								FROM Message 
								WHERE message_recipient_id = ?
								ORDER BY message_date_sent DESC
							', array($p_data));
						break;

						case 'recipient_unread': 
							$query = $this->db->query('
								SELECT *
								FROM Message 
								WHERE message_recipient_id = ? AND message_read = 0
								ORDER BY message_date_sent DESC
							', array($p_data));
						break;
					}
				break;

				case 'all':
					$query = $this->db->query('
						SELECT *
						FROM Message 
						ORDER BY message_date_sent DESC
					');
				break;
			}

			return $query;
		}

		return null;
	}

}
?>