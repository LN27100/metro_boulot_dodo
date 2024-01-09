USE metro_boulot_dodo;
CREATE TABLE enterprise(
   enterprise_id INT AUTO_INCREMENT,
   enterprise_name VARCHAR(50),
   enterprise_Email VARCHAR(50),
   enterprise_Siret INT,
   enterprise_Adress VARCHAR(50),
   enterprise_Password VARCHAR(20),
   enterprise_Zipcode INT,
   enterprise_City VARCHAR(25),
   enterprise_Photo VARCHAR(50),
   PRIMARY KEY(enterprise_id)
);

CREATE TABLE admin(
   admin_id INT AUTO_INCREMENT,
   admin_Email VARCHAR(50),
   admin_Password VARCHAR(20),
   PRIMARY KEY(admin_id)
);

CREATE TABLE transport(
   transport_id INT AUTO_INCREMENT,
   transport_type VARCHAR(50),
   PRIMARY KEY(transport_id)
);

CREATE TABLE userProfil(
   user_id INT AUTO_INCREMENT,
   user_Name VARCHAR(50),
   user_Firstname VARCHAR(50),
   user_Pseudo VARCHAR(50),
   user_Describ VARCHAR(300),
   user_Email VARCHAR(50),
   user_Dateofbirth DATE,
   user_password VARCHAR(20),
   user_Photo VARCHAR(50),
   enterprise_id INT NOT NULL,
   PRIMARY KEY(user_id),
   FOREIGN KEY(enterprise_id) REFERENCES enterprise(enterprise_id)
);

CREATE TABLE Events(
   events_id INT AUTO_INCREMENT,
   events_Startdate DATE,
   events_Challengedescrib VARCHAR(300),
   events_photo VARCHAR(50),
   events_EndDate DATE,
   events_Challengename VARCHAR(50),
   enterprise_id INT NOT NULL,
   PRIMARY KEY(events_id),
   FOREIGN KEY(enterprise_id) REFERENCES enterprise(enterprise_id)
);

CREATE TABLE ride(
   ride_id INT AUTO_INCREMENT,
   ride_type VARCHAR(50),
   ride_date DATE,
   ride_distance DECIMAL(15,2),
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
   FOREIGN KEY(events_id) REFERENCES Events(events_id),
   FOREIGN KEY(transport_id) REFERENCES transport(transport_id)
);
