SELECT SUM(ride_distance) AS 'Somme des trajets par entreprise'
FROM ride
INNER JOIN enterprise ON enterprise_id = transport_id
