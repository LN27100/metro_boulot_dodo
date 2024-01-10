SELECT events_startdate, events_challengedescrib, events_photo, events_enddate, events_challengename, transport_type, GROUP_CONCAT(`transport_id`) AS 'Détails challenge avec mode transports'
FROM transport_pris_en_compte
NATURAL JOIN transport 
NATURAL JOIN events
GROUP BY enterprise_id
