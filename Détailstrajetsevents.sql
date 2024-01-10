SELECT ride_id, ride_date, ride_distance, ride_photo, user_id, transport_id
FROM ride
WHERE ride_date BETWEEN '2024-02-01' AND '2024-05-31'
  AND transport_id IN (1, 5); -- Vélo (ID 1) et Marche (ID 5)