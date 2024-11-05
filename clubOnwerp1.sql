-- Maak de database aan
CREATE DATABASE SportclubsDB;
USE SportclubsDB;

-- Tabel voor de clubs
CREATE TABLE clubs (
    club_id INT AUTO_INCREMENT PRIMARY KEY,
    naam VARCHAR(50) NOT NULL,
    locatie VARCHAR(100),
    sportsoort VARCHAR(50),
    oprichtingsjaar YEAR,
    aantal_leden INT DEFAULT 0
);

-- Tabel voor de leden
CREATE TABLE leden (
    lid_id INT AUTO_INCREMENT PRIMARY KEY,
    naam VARCHAR(50) NOT NULL,
    geboortedatum DATE,
    geslacht ENUM('M', 'V', 'Overig') DEFAULT 'Overig',
    straat VARCHAR(100),
    huisnummer VARCHAR(10),
    postnummer VARCHAR(10),
    plaats VARCHAR(100),
    inschrijving DATE,
    uitschrijving DATE,
    club_id INT,
    FOREIGN KEY (club_id) REFERENCES clubs(club_id)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);
