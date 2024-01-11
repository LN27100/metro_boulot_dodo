SELECT SUM(ride_distance) AS 'total_trajet_Dream_Stones'
FROM ride
INNER JOIN enterprise ON enterprise_id = transport_id
WHERE enterprise_id = 2;
