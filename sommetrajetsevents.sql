SELECT SUM(ride_distance) AS total_distance
FROM ride
WHERE ride_date BETWEEN '2024-02-01' AND '2024-05-31'
  AND transport_id IN (1, 5); 