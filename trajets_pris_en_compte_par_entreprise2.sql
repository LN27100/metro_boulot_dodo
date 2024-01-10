SELECT ride_id FROM ride 
INNER JOIN enterprise ON transport_id = enterprise_id
WHERE enterprise_id = 2