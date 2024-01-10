use metro_boulot_dodo;
CREATE TABLE enterprise(
   enterprise_id INT AUTO_INCREMENT,
   enterprise_name VARCHAR(50),
   enterprise_email VARCHAR(50),
   enterprise_siret INT,
   enterprise_adress VARCHAR(50),
   enterprise_password VARCHAR(255),
   enterprise_zipcode INT,
   enterprise_city VARCHAR(25),
   enterprise_photo VARCHAR(50),
   PRIMARY KEY(enterprise_id),
   UNIQUE(enterprise_siret)
);

CREATE TABLE admin(
   admin_id INT AUTO_INCREMENT,
   admin_email VARCHAR(50),
   admin_password VARCHAR(255),
   PRIMARY KEY(admin_id),
   UNIQUE(admin_email)
);

CREATE TABLE transport(
   transport_id INT AUTO_INCREMENT,
   transport_type VARCHAR(50),
   PRIMARY KEY(transport_id)
);

CREATE TABLE userProfil(
   user_id INT AUTO_INCREMENT,
   user_validate tinyint NOT NULL,
   user_name VARCHAR(50),
   user_firstname VARCHAR(50),
   user_pseudo VARCHAR(50),
   user_describ VARCHAR(300),
   user_email VARCHAR(50),
   user_dateofbirth DATE,
   user_password VARCHAR(255),
   user_photo VARCHAR(50),
   enterprise_id INT NOT NULL,
   PRIMARY KEY(user_id),
   UNIQUE(user_email),
   FOREIGN KEY(enterprise_id) REFERENCES enterprise(enterprise_id)
);

CREATE TABLE events(
   events_id INT AUTO_INCREMENT,
   events_startdate DATE,
   events_challengedescrib VARCHAR(300),
   events_photo VARCHAR(50),
   events_enddate DATE,
   events_challengename VARCHAR(50),
   enterprise_id INT NOT NULL,
   PRIMARY KEY(events_id),
   FOREIGN KEY(enterprise_id) REFERENCES enterprise(enterprise_id)
);

CREATE TABLE ride(
   ride_id INT AUTO_INCREMENT,
   ride_date DATE,
   ride_distance DECIMAL(3,2),
   ride_photo VARCHAR(50),
   user_id INT NOT NULL,
   transport_id INT NOT NULL,
   PRIMARY KEY(ride_id),
   FOREIGN KEY(user_id) REFERENCES userProfil(user_id),
   FOREIGN KEY(transport_id) REFERENCES transport(transport_id)
);

CREATE TABLE transport_pris_en_compte(
   events_id INT,
   transport_id INT,
   PRIMARY KEY(events_id, transport_id),
   FOREIGN KEY(events_id) REFERENCES events(events_id),
   FOREIGN KEY(transport_id) REFERENCES transport(transport_id)
);
