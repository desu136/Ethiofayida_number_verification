<?php
create database fayidaNumber
CREATE TABLE users (
  userid INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin', 'editor', 'viewer') NOT NULL DEFAULT 'viewer',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE fayida_citizens (
  fayida_number VARCHAR(20) PRIMARY KEY,
  full_name VARCHAR(100),
  date_of_birth DATE,
  gender VARCHAR(10),
  region VARCHAR(50),
  kebele VARCHAR(50),
  phone_number VARCHAR(20),
  photo TEXT
);


CREATE TABLE criminal_records (
  record_id INT AUTO_INCREMENT PRIMARY KEY,
  fayida_number VARCHAR(20),
  crime_type VARCHAR(100),
  case_reference VARCHAR(50),
  conviction_date DATE,
  status ENUM('active', 'resolved'),
  notes TEXT,
  FOREIGN KEY (fayida_number) REFERENCES fayida_citizens(fayida_number)
);
?>