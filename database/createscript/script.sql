SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

USE voedselbank2;

-- --------------------------------------------------------
-- DROP TABLES
-- --------------------------------------------------------

DROP TABLE IF EXISTS
    AllergiePerPersoon,
    RolPerGebruiker,
    ContactPerLeverancier,
    ContactPerGezin,
    EetwensPerGezin,
    ProductPerVoedselpakket,
    ProductPerLeverancier,
    ProductPerMagazijn,

    Allergie,
    Rol,
    Categorie,
    Contact,
    Eetwens,
    Gezin,
    Leverancier,
    Magazijn,
    Persoon,
    Product,
    Voedselpakket,
    users,

    voedselpakket_producten,
    voedselpakketten,
    levering_producten,
    leveringen,
    product_allergenen,
    product_kenmerken,
    producten,
    klant_allergenen,
    klant_wensen,
    klanten,
    gezinnen,
    leveranciers,
    contactpersonen,
    allergenen,
    wensen,
    product_categorieen,
    adressen,
    roles;
-- --------------------------------------------------------
-- Users (Gebruiker)
-- --------------------------------------------------------
CREATE TABLE users (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    PersoonId INT UNSIGNED NULL,
    name VARCHAR(255) NOT NULL, -- InlogNaam
    email VARCHAR(255) NOT NULL, -- Gebruikersnaam
    email_verified_at TIMESTAMP NULL DEFAULT NULL,
    password VARCHAR(255) NOT NULL, -- Wachtwoord
    IsIngelogd BIT(1) NOT NULL DEFAULT 0,
    Ingelogd DATETIME NULL,
    Uitgelogd DATETIME NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    -- System fields
    IsActief BIT(1) NOT NULL DEFAULT 1,
    Opmerking VARCHAR(255) NULL,
    DatumAangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    DatumGewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),

    PRIMARY KEY (id),
    UNIQUE KEY users_email_unique (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Allergie
-- --------------------------------------------------------
CREATE TABLE Allergie (
    Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    Naam VARCHAR(100) NOT NULL,
    Omschrijving VARCHAR(255) NULL,
    AnafylactischRisico VARCHAR(50) NULL,

    IsActief BIT(1) NOT NULL DEFAULT 1,
    Opmerking VARCHAR(255) NULL,
    DatumAangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    DatumGewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    PRIMARY KEY (Id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Rol
-- --------------------------------------------------------
CREATE TABLE Rol (
    Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    Naam VARCHAR(100) NOT NULL,

    IsActief BIT(1) NOT NULL DEFAULT 1,
    Opmerking VARCHAR(255) NULL,
    DatumAangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    DatumGewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    PRIMARY KEY (Id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Categorie
-- --------------------------------------------------------
CREATE TABLE Categorie (
    Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    Naam VARCHAR(100) NOT NULL,
    Omschrijving VARCHAR(255) NULL,

    IsActief BIT(1) NOT NULL DEFAULT 1,
    Opmerking VARCHAR(255) NULL,
    DatumAangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    DatumGewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    PRIMARY KEY (Id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Contact
-- --------------------------------------------------------
CREATE TABLE Contact (
    Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    Straat VARCHAR(255) NOT NULL,
    Huisnummer VARCHAR(20) NOT NULL,
    Toevoeging VARCHAR(20) NULL,
    Postcode VARCHAR(10) NOT NULL,
    Woonplaats VARCHAR(100) NOT NULL,
    Email VARCHAR(255) NULL,
    Mobiel VARCHAR(20) NULL,

    IsActief BIT(1) NOT NULL DEFAULT 1,
    Opmerking VARCHAR(255) NULL,
    DatumAangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    DatumGewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    PRIMARY KEY (Id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Eetwens
-- --------------------------------------------------------
CREATE TABLE Eetwens (
    Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    Naam VARCHAR(100) NOT NULL,
    Omschrijving VARCHAR(255) NULL,

    IsActief BIT(1) NOT NULL DEFAULT 1,
    Opmerking VARCHAR(255) NULL,
    DatumAangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    DatumGewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    PRIMARY KEY (Id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Gezin
-- --------------------------------------------------------
CREATE TABLE Gezin (
    Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    Naam VARCHAR(255) NOT NULL,
    Code VARCHAR(20) NULL,
    Omschrijving VARCHAR(255) NULL,
    AantalVolwassenen INT NOT NULL DEFAULT 0,
    AantalKinderen INT NOT NULL DEFAULT 0,
    AantalBabys INT NOT NULL DEFAULT 0,
    TotaalAantalPersonen INT NOT NULL DEFAULT 0,

    IsActief BIT(1) NOT NULL DEFAULT 1,
    Opmerking VARCHAR(255) NULL,
    DatumAangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    DatumGewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    PRIMARY KEY (Id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Leverancier
-- --------------------------------------------------------
CREATE TABLE Leverancier (
    Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    Naam VARCHAR(255) NOT NULL,
    ContactPersoon VARCHAR(255) NULL,
    LeverancierNummer VARCHAR(50) NULL,
    LeverancierType VARCHAR(50) NULL,

    IsActief BIT(1) NOT NULL DEFAULT 1,
    Opmerking VARCHAR(255) NULL,
    DatumAangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    DatumGewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    PRIMARY KEY (Id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Magazijn
-- --------------------------------------------------------
CREATE TABLE Magazijn (
    Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    Ontvangstdatum DATE NULL,
    Uitleveringsdatum DATE NULL,
    VerpakkingsEenheid VARCHAR(50) NULL,
    Aantal INT NOT NULL DEFAULT 0,

    IsActief BIT(1) NOT NULL DEFAULT 1,
    Opmerking VARCHAR(255) NULL,
    DatumAangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    DatumGewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    PRIMARY KEY (Id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Persoon
-- --------------------------------------------------------
CREATE TABLE Persoon (
    Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    GezinId INT UNSIGNED NULL,
    Voornaam VARCHAR(255) NOT NULL,
    Tussenvoegsel VARCHAR(50) NULL,
    Achternaam VARCHAR(255) NOT NULL,
    Geboortedatum DATE NULL,
    TypePersoon VARCHAR(50) NULL,
    IsVertegenwoordiger BIT(1) NOT NULL DEFAULT 0,

    IsActief BIT(1) NOT NULL DEFAULT 1,
    Opmerking VARCHAR(255) NULL,
    DatumAangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    DatumGewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    PRIMARY KEY (Id),
    CONSTRAINT fk_persoon_gezin FOREIGN KEY (GezinId) REFERENCES Gezin (Id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Add User FK now that Persoon exists
ALTER TABLE users ADD CONSTRAINT fk_users_persoon FOREIGN KEY (PersoonId) REFERENCES Persoon (Id);

-- --------------------------------------------------------
-- Product
-- --------------------------------------------------------
CREATE TABLE Product (
    Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    CategorieId INT UNSIGNED NOT NULL,
    Naam VARCHAR(255) NOT NULL,
    SoortAllergie VARCHAR(255) NULL,
    Barcode VARCHAR(50) NULL,
    Houdbaarheidsdatum DATE NULL,
    Omschrijving VARCHAR(255) NULL,
    Status VARCHAR(50) NULL,

    IsActief BIT(1) NOT NULL DEFAULT 1,
    Opmerking VARCHAR(255) NULL,
    DatumAangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    DatumGewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    PRIMARY KEY (Id),
    CONSTRAINT fk_product_categorie FOREIGN KEY (CategorieId) REFERENCES Categorie (Id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Voedselpakket
-- --------------------------------------------------------
CREATE TABLE Voedselpakket (
    Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    GezinId INT UNSIGNED NOT NULL,
    PakketNummer INT NOT NULL,
    DatumSamenstelling DATETIME NULL,
    DatumUitgifte DATETIME NULL,
    Status VARCHAR(50) NULL,

    IsActief BIT(1) NOT NULL DEFAULT 1,
    Opmerking VARCHAR(255) NULL,
    DatumAangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    DatumGewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    PRIMARY KEY (Id),
    CONSTRAINT fk_voedselpakket_gezin FOREIGN KEY (GezinId) REFERENCES Gezin (Id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------
-- Junction Tables
-- --------------------------------------------------------

CREATE TABLE AllergiePerPersoon (
    Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    PersoonId INT UNSIGNED NOT NULL,
    AllergieId INT UNSIGNED NOT NULL,

    IsActief BIT(1) NOT NULL DEFAULT 1,
    Opmerking VARCHAR(255) NULL,
    DatumAangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    DatumGewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    PRIMARY KEY (Id),
    CONSTRAINT fk_app_persoon FOREIGN KEY (PersoonId) REFERENCES Persoon (Id),
    CONSTRAINT fk_app_allergie FOREIGN KEY (AllergieId) REFERENCES Allergie (Id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE RolPerGebruiker (
    Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    GebruikerId INT UNSIGNED NOT NULL,
    RolId INT UNSIGNED NOT NULL,

    IsActief BIT(1) NOT NULL DEFAULT 1,
    Opmerking VARCHAR(255) NULL,
    DatumAangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    DatumGewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    PRIMARY KEY (Id),
    CONSTRAINT fk_rpg_user FOREIGN KEY (GebruikerId) REFERENCES users (id),
    CONSTRAINT fk_rpg_rol FOREIGN KEY (RolId) REFERENCES Rol (Id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE ContactPerLeverancier (
    Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    LeverancierId INT UNSIGNED NOT NULL,
    ContactId INT UNSIGNED NOT NULL,

    IsActief BIT(1) NOT NULL DEFAULT 1,
    Opmerking VARCHAR(255) NULL,
    DatumAangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    DatumGewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    PRIMARY KEY (Id),
    CONSTRAINT fk_cpl_leverancier FOREIGN KEY (LeverancierId) REFERENCES Leverancier (Id),
    CONSTRAINT fk_cpl_contact FOREIGN KEY (ContactId) REFERENCES Contact (Id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE ContactPerGezin (
    Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    GezinId INT UNSIGNED NOT NULL,
    ContactId INT UNSIGNED NOT NULL,

    IsActief BIT(1) NOT NULL DEFAULT 1,
    Opmerking VARCHAR(255) NULL,
    DatumAangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    DatumGewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    PRIMARY KEY (Id),
    CONSTRAINT fk_cpg_gezin FOREIGN KEY (GezinId) REFERENCES Gezin (Id),
    CONSTRAINT fk_cpg_contact FOREIGN KEY (ContactId) REFERENCES Contact (Id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE EetwensPerGezin (
    Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    GezinId INT UNSIGNED NOT NULL,
    EetwensId INT UNSIGNED NOT NULL,

    IsActief BIT(1) NOT NULL DEFAULT 1,
    Opmerking VARCHAR(255) NULL,
    DatumAangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    DatumGewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    PRIMARY KEY (Id),
    CONSTRAINT fk_epg_gezin FOREIGN KEY (GezinId) REFERENCES Gezin (Id),
    CONSTRAINT fk_epg_eetwens FOREIGN KEY (EetwensId) REFERENCES Eetwens (Id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE ProductPerVoedselpakket (
    Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    VoedselpakketId INT UNSIGNED NOT NULL,
    ProductId INT UNSIGNED NOT NULL,
    AantalProductEenheden INT NOT NULL DEFAULT 0,

    IsActief BIT(1) NOT NULL DEFAULT 1,
    Opmerking VARCHAR(255) NULL,
    DatumAangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    DatumGewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    PRIMARY KEY (Id),
    CONSTRAINT fk_ppv_voedselpakket FOREIGN KEY (VoedselpakketId) REFERENCES Voedselpakket (Id),
    CONSTRAINT fk_ppv_product FOREIGN KEY (ProductId) REFERENCES Product (Id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE ProductPerLeverancier (
    Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    LeverancierId INT UNSIGNED NOT NULL,
    ProductId INT UNSIGNED NOT NULL,
    DatumAangeleverd DATE NULL,
    DatumEerstVolgendeLevering DATE NULL,

    IsActief BIT(1) NOT NULL DEFAULT 1,
    Opmerking VARCHAR(255) NULL,
    DatumAangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    DatumGewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    PRIMARY KEY (Id),
    CONSTRAINT fk_ppl_leverancier FOREIGN KEY (LeverancierId) REFERENCES Leverancier (Id),
    CONSTRAINT fk_ppl_product FOREIGN KEY (ProductId) REFERENCES Product (Id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE ProductPerMagazijn (
    Id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    ProductId INT UNSIGNED NOT NULL,
    MagazijnId INT UNSIGNED NOT NULL,
    Locatie VARCHAR(100) NULL,

    IsActief BIT(1) NOT NULL DEFAULT 1,
    Opmerking VARCHAR(255) NULL,
    DatumAangemaakt DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
    DatumGewijzigd DATETIME(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
    PRIMARY KEY (Id),
    CONSTRAINT fk_ppm_product FOREIGN KEY (ProductId) REFERENCES Product (Id),
    CONSTRAINT fk_ppm_magazijn FOREIGN KEY (MagazijnId) REFERENCES Magazijn (Id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------
-- INSERT DATA
-- --------------------------------------------------------

INSERT INTO Allergie (Id, Naam, Omschrijving, AnafylactischRisico) VALUES
(1, 'Gluten', 'Allergisch voor gluten', 'zeerlaag'),
(2, 'Pindas', 'Allergisch voor pindas', 'Hoog'),
(3, 'Schaaldieren', 'Allergisch voor schaaldieren', 'RedelijkHoog'),
(4, 'Hazelnoten', 'Allergisch voor hazelnoten', 'laag'),
(5, 'Lactose', 'Allergisch voor lactose', 'Zeerlaag'),
(6, 'Soja', 'Allergisch voor soja', 'Zeerlaag');

INSERT INTO Rol (Id, Naam) VALUES
(1, 'Manager'),
(2, 'Medewerker'),
(3, 'Vrijwilliger');

INSERT INTO Categorie (Id, Naam, Omschrijving) VALUES
(1, 'AGF', 'Aardappelen groente en fruit'),
(2, 'KV', 'Kaas en vleeswaren'),
(3, 'ZPE', 'Zuivel plantaardig en eieren'),
(4, 'BB', 'Bakkerij en Banket'),
(5, 'FSKT', 'Frisdranken, sappen, koffie en thee'),
(6, 'PRW', 'Pasta, rijst en wereldkeuken'),
(7, 'SSKO', 'Soepen, sauzen, kruiden en olie'),
(8, 'SKCC', 'Snoep, koek, chips en chocolade'),
(9, 'BVH', 'Baby, verzorging en hygiëne');

INSERT INTO Contact (Id, Straat, Huisnummer, Toevoeging, Postcode, Woonplaats, Email, Mobiel) VALUES
(1, 'Prinses Irenestraat', '12', 'A', '5271TH', 'Maaskantje', 'j.van.zevenhuizen@gmail.com', '+31 623456123'),
(2, 'Gibraltarstraat', '234', NULL, '5271TJ', 'Maaskantje', 'a.bergkamp@hotmail.com', '+31 623456123'),
(3, 'Der Kinderenstraat', '456', 'Bis', '5271TH', 'Maaskantje', 's.van.de.heuvel@gmail.com', '+31 623456123'),
(4, 'Nachtegaalstraat', '233', 'A', '5271TJ', 'Maaskantje', 'e.scherder@gmail.com', '+31 623456123'),
(5, 'Bertram Russellstraat', '45', NULL, '5271TH', 'Maaskantje', 'f.de.jong@hotmail.com', '+31 623456123'),
(6, 'Leonardo Da VinciHof', '34', NULL, '5271ZE', 'Maaskantje', 'h.van.der.berg@gmail.com', '+31 623456123'),
(7, 'Siegfried Knutsenlaan', '234', NULL, '5271ZE', 'Maaskantje', 'r.ter.weijden@ah.nl', '+31 623456123'),
(8, 'Theo de Bokstraat', '256', NULL, '5271ZH', 'Maaskantje', 'l.pastoor@gmail.com', '+31 623456123'),
(9, 'Meester van Leerhof', '2', 'A', '5271ZH', 'Maaskantje', 'm.yazidi@gemeenteutrecht.nl', '+31 623456123'),
(10, 'Van Wemelenplantsoen', '300', NULL, '5271TH', 'Maaskantje', 'b.van.driel@gmail.com', '+31 623456123'),
(11, 'Terlingenhof', '20', NULL, '5271TH', 'Maaskantje', 'j.pastorius@gmail.com', '+31 623456356'),
(12, 'Veldhoen', '31', NULL, '5271ZE', 'Maaskantje', 's.dollaard@gmail.com', '+31 623452314'),
(13, 'ScheringaDreef', '37', NULL, '5271ZE', 'Vught', 'j.blokker@gemeentevught.nl', '+31 623452314');

INSERT INTO Eetwens (Id, Naam, Omschrijving) VALUES
(1, 'GeenVarken', 'Geen Varkensvlees'),
(2, 'Veganistisch', 'Geen zuivelproducten en vlees'),
(3, 'Vegetarisch', 'Geen vlees'),
(4, 'Omnivoor', 'Geen beperkingen');

INSERT INTO Gezin (Id, Naam, Code, Omschrijving, AantalVolwassenen, AantalKinderen, AantalBabys, TotaalAantalPersonen) VALUES
(1, 'ZevenhuizenGezin', 'G0001', 'Bijstandsgezin', 2, 2, 0, 4),
(2, 'BergkampGezin', 'G0002', 'Bijstandsgezin', 2, 1, 1, 4),
(3, 'HeuvelGezin', 'G0003', 'Bijstandsgezin', 2, 0, 0, 2),
(4, 'ScherderGezin', 'G0004', 'Bijstandsgezin', 1, 0, 2, 3),
(5, 'DeJongGezin', 'G0005', 'Bijstandsgezin', 1, 1, 0, 2),
(6, 'VanderBergGezin', 'G0006', 'AlleenGaande', 1, 0, 0, 1);

INSERT INTO Leverancier (Id, Naam, ContactPersoon, LeverancierNummer, LeverancierType) VALUES
(1, 'Albert Heijn', 'Ruud ter Weijden', 'L0001', 'Bedrijf'),
(2, 'Albertus Kerk', 'Leo Pastoor', 'L0002', 'Instelling'),
(3, 'Gemeente Utrecht', 'Mohammed Yazidi', 'L0003', 'Overheid'),
(4, 'Boerderij Meerhoven', 'Bertus van Driel', 'L0004', 'Particulier'),
(5, 'Jan van der Heijden', 'Jan van der Heijden', 'L0005', 'Donor'),
(6, 'Vomar', 'Jaco Pastorius', 'L0006', 'Bedrijf'),
(7, 'DekaMarkt', 'Sil den Dollaard', 'L0007', 'Bedrijf'),
(8, 'Gemeente Vught', 'Jan Blokker', 'L0008', 'Overheid');

INSERT INTO Magazijn (Id, Ontvangstdatum, Uitleveringsdatum, VerpakkingsEenheid, Aantal) VALUES
(1, '2026-01-12', NULL, '5 kg', 20),
(2, '2026-01-02', NULL, '2.5 kg', 40),
(3, '2026-01-16', NULL, '1 kg', 30),
(4, '2026-01-08', NULL, '1.5 kg', 25),
(5, '2026-01-06', NULL, '4 stuks', 75),
(6, '2026-01-12', NULL, '1 kg/tros', 60),
(7, '2026-01-20', NULL, '2 kg/tros', 200),
(8, '2026-01-02', NULL, '200 g', 45),
(9, '2026-01-04', NULL, '100 g', 60),
(10, '2026-01-07', NULL, '1 liter', 120),
(11, '2026-01-01', NULL, '250 g', 80),
(12, '2026-01-18', NULL, '6 stuks', 120),
(13, '2026-01-19', NULL, '800 g', 220),
(14, '2026-01-10', NULL, '1 stuk', 130),
(15, '2026-01-13', NULL, '150 ml', 72),
(16, '2026-01-18', NULL, '1 l', 12),
(17, '2026-01-11', NULL, '250 g', 300),
(18, '2026-01-02', NULL, '25 zakjes', 280),
(19, '2026-01-09', NULL, '500 g', 330),
(20, '2026-01-03', NULL, '1 kg', 34),
(21, '2026-01-02', NULL, '50 g', 23),
(22, '2026-01-16', NULL, '1 l', 46),
(23, '2026-01-14', NULL, '250 ml', 98),
(24, '2026-01-07', NULL, '1 potje', 56),
(25, '2026-01-17', NULL, '1 l', 210),
(26, '2026-01-05', NULL, '4 stuks', 24),
(27, '2026-01-07', NULL, '300 g', 87),
(28, '2026-01-06', NULL, '200 g', 230),
(29, '2026-01-08', NULL, '80 g', 30);

INSERT INTO Persoon (Id, GezinId, Voornaam, Tussenvoegsel, Achternaam, Geboortedatum, TypePersoon, IsVertegenwoordiger) VALUES
(1, NULL, 'Hans', 'van', 'Leeuwen', '1958-02-12', 'Manager', 0),
(2, NULL, 'Jan', 'van der', 'Sluijs', '1993-04-30', 'Medewerker', 0),
(3, NULL, 'Herman', 'den', 'Duiker', '1989-08-30', 'Vrijwilliger', 0),
(4, 1, 'Johan', 'van', 'Zevenhuizen', '1990-05-20', 'Klant', 1),
(5, 1, 'Sarah', 'den', 'Dolder', '1985-03-23', 'Klant', 0),
(6, 1, 'Theo', 'van', 'Zevenhuizen', '2015-03-08', 'Klant', 0),
(7, 1, 'Jantien', 'van', 'Zevenhuizen', '2016-09-20', 'Klant', 0),
(8, 2, 'Arjan', NULL, 'Bergkamp', '1968-07-12', 'Klant', 1),
(9, 2, 'Janneke', NULL, 'Sanders', '1969-05-11', 'Klant', 0),
(10, 2, 'Stein', NULL, 'Bergkamp', '2009-02-02', 'Klant', 0),
(11, 2, 'Judith', NULL, 'Bergkamp', '2022-02-05', 'Klant', 0),
(12, 3, 'Mazin', 'van', 'Vliet', '1968-08-18', 'Klant', 0),
(13, 3, 'Selma', 'van de', 'Heuvel', '1965-09-04', 'Klant', 1),
(14, 4, 'Eva', NULL, 'Scherder', '2000-04-07', 'Klant', 1),
(15, 4, 'Felicia', NULL, 'Scherder', '2021-11-29', 'Klant', 0),
(16, 4, 'Devin', NULL, 'Scherder', '2024-03-01', 'Klant', 0),
(17, 5, 'Frieda', 'de', 'Jong', '1980-09-04', 'Klant', 1),
(18, 5, 'Simeon', 'de', 'Jong', '2018-05-23', 'Klant', 0),
(19, 6, 'Hanna', 'van der', 'Berg', '1999-09-09', 'Klant', 1);

INSERT INTO users (id, PersoonId, name, email, password, IsIngelogd, Ingelogd, Uitgelogd, created_at, updated_at) VALUES
(1, 1, 'Hans', 'hans@maaskantje.nl', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, '2026-01-13 17:03:06', NULL, NOW(), NOW()),
(2, 2, 'Jan', 'jan@maaskantje.nl', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, '2026-01-18 15:13:23', '2026-01-18 15:23:46', NOW(), NOW()),
(3, 3, 'Herman', 'herman@maaskantje.nl', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, '2026-01-20 12:05:20', NULL, NOW(), NOW());

INSERT INTO Product (Id, CategorieId, Naam, SoortAllergie, Barcode, Houdbaarheidsdatum, Omschrijving, Status) VALUES
(1, 1, 'Aardappel', NULL, '8719587321239', '2026-02-12', 'Kruimige aardappel', 'OpVoorraad'),
(2, 1, 'Aardappel', NULL, '8719587321239', '2026-02-26', 'Kruimige aardappel', 'OpVoorraad'),
(3, 1, 'Ui', NULL, '8719437321335', '2026-02-02', 'Gele ui', 'NietOpVoorraad'),
(4, 1, 'Appel', NULL, '8719486321332', '2026-02-16', 'Granny Smith', 'NietLeverbaar'),
(5, 1, 'Appel', NULL, '8719486321332', '2026-02-23', 'Granny Smith', 'NietLeverbaar'),
(6, 1, 'Banaan', 'Banaan', '8719484321336', '2026-02-12', 'Biologische Banaan', 'OverHoudbaarheidsDatum'),
(7, 1, 'Banaan', 'Banaan', '8719484321336', '2026-02-19', 'Biologische Banaan', 'OverHoudbaarheidsDatum'),
(8, 2, 'Kaas', 'Lactose', '8719487421338', '2026-02-19', 'Jonge Kaas', 'OpVoorraad'),
(9, 2, 'Rosbief', NULL, '8719487421331', '2026-02-23', 'Rundvlees', 'OpVoorraad'),
(10, 3, 'Melk', 'Lactose', '8719447321332', '2026-02-23', 'Halfvolle melk', 'OpVoorraad'),
(11, 3, 'Margarine', NULL, '8719486321336', '2026-02-02', 'Plantaardige boter', 'OpVoorraad'),
(12, 3, 'Ei', 'Eier', '8719487421334', '2026-02-04', 'Scharrelei', 'OpVoorraad'),
(13, 4, 'Brood', 'Gluten', '8719487721337', '2026-02-07', 'Volkoren brood', 'OpVoorraad'),
(14, 4, 'Gevulde Koek', 'Amandel', '8719483321333', '2026-02-04', 'Banketbakkers kwaliteit', 'OpVoorraad'),
(15, 5, 'Fristi', 'Lactose', '8719487121331', '2026-02-28', 'Frisdrank', 'NietOpVoorraad'),
(16, 5, 'Appelsap', NULL, '8719487521335', '2026-02-19', '100% vruchtensap', 'OpVoorraad'),
(17, 5, 'Koffie', 'Caffeïne', '8719487381338', '2026-02-23', 'Arabica koffie', 'OverHoudbaarheidsDatum'),
(18, 5, 'Thee', 'Theïne', '8719487329339', '2026-02-02', 'Ceylon thee', 'OpVoorraad'),
(19, 6, 'Pasta', 'Gluten', '8719487321334', '2026-02-16', 'Macaroni', 'NietLeverbaar'),
(20, 6, 'Rijst', NULL, '8719487331332', '2026-02-25', 'Basmati Rijst', 'OpVoorraad'),
(21, 6, 'Knorr Nasi Mix', NULL, '871948735135', '2026-02-13', 'Nasi kruiden', 'OpVoorraad'),
(22, 7, 'Tomatensoep', NULL, '8719487371337', '2026-02-23', 'Romige tomatensoep', 'OpVoorraad'),
(23, 7, 'Tomatensaus', NULL, '8719487341334', '2026-02-21', 'Pizza saus', 'NietOpVoorraad'),
(24, 7, 'Peterselie', NULL, '8719487321636', '2026-02-31', 'Verse kruidenpot', 'OpVoorraaad'),
(25, 8, 'Olie', NULL, '8719487327337', '2026-02-27', 'Olijfolie', 'OpVoorraad'),
(26, 8, 'Mars', NULL, '8719487324334', '2026-02-11', 'Snoep', 'OpVoorraad'),
(27, 8, 'Biscuit', NULL, '8719487311331', '2026-02-07', 'San Francisco biscuit', 'OpVoorraad'),
(28, 8, 'Paprika Chips', NULL, '87194873218398', '2026-02-22', 'Ribbelchips paprika', 'OpVoorraad'),
(29, 8, 'Chocolade reep', 'Cacoa', '8719487321533', '2026-02-21', 'Tony Chocolonely', 'OpVoorraad');

INSERT INTO Voedselpakket (Id, GezinId, PakketNummer, DatumSamenstelling, DatumUitgifte, Status) VALUES
(1, 1, 1, '2026-01-21', '2026-01-21', 'Uitgereikt'),
(2, 1, 2, '2026-01-19', NULL, 'NietUitgereikt'),
(3, 1, 3, '2026-01-17', NULL, 'NietMeerIngeschreven'),
(4, 2, 4, '2026-01-10', '2026-01-14', 'Uitgereikt'),
(5, 2, 5, '2026-01-18', '2026-01-20', 'Uitgereikt'),
(6, 2, 6, '2026-01-08', NULL, 'NietUitgereikt');

INSERT INTO AllergiePerPersoon (Id, PersoonId, AllergieId) VALUES
(1, 4, 1),
(2, 5, 2),
(3, 6, 3),
(4, 7, 4),
(5, 8, 3),
(6, 9, 2),
(7, 5, 8),
(12, 2, 9),
(13, 4, 10),
(14, 1, 11),
(15, 3, 12),
(16, 5, 13),
(17, 1, 14),
(18, 2, 15),
(19, 4, 16),
(20, 4, 4);

INSERT INTO RolPerGebruiker (Id, GebruikerId, RolId) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3);

INSERT INTO ContactPerLeverancier (Id, LeverancierId, ContactId) VALUES
(1, 1, 7),
(2, 2, 8),
(3, 3, 9),
(4, 4, 10),
(5, 5, 6),
(6, 6, 7),
(7, 7, 8);

INSERT INTO ContactPerGezin (Id, GezinId, ContactId) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5),
(6, 6, 6);

INSERT INTO EetwensPerGezin (Id, GezinId, EetwensId) VALUES
(1, 1, 2),
(2, 2, 4),
(3, 3, 4),
(4, 4, 3),
(5, 5, 2);

INSERT INTO ProductPerVoedselpakket (Id, VoedselpakketId, ProductId, AantalProductEenheden) VALUES
(1, 1, 7, 1),
(2, 1, 8, 2),
(3, 1, 9, 1),
(4, 2, 12, 1),
(5, 2, 13, 2),
(6, 2, 6, 2),
(7, 1, 7, 3),
(8, 2, 6, 2),
(9, 1, 7, 3),
(10, 1, 8, 3),
(11, 1, 9, 4),
(12, 4, 20, 1),
(13, 4, 19, 1),
(14, 4, 21, 1),
(15, 5, 24, 1),
(16, 5, 25, 1),
(17, 5, 26, 1),
(18, 6, 27, 1);

INSERT INTO ProductPerLeverancier (Id, LeverancierId, ProductId, DatumAangeleverd, DatumEerstVolgendeLevering) VALUES
(1, 4, 1, '2026-01-12', '2026-01-15'),
(2, 4, 2, '2026-01-02', '2026-01-05'),
(3, 2, 3, '2026-01-16', '2026-01-18'),
(4, 1, 4, '2026-01-08', '2026-01-11'),
(5, 4, 5, '2026-01-06', '2026-01-10'),
(6, 1, 6, '2026-01-12', '2026-01-15'),
(7, 4, 7, '2026-01-20', '2026-01-21'),
(8, 4, 8, '2026-01-02', '2026-01-08'),
(9, 4, 9, '2026-01-04', '2026-01-09'),
(10, 3, 10, '2026-01-07', '2026-01-11'),
(11, 3, 11, '2026-01-01', '2026-01-06'),
(12, 3, 12, '2026-01-18', '2026-01-20'),
(13, 3, 13, '2026-01-19', '2026-01-20'),
(14, 2, 14, '2026-01-10', '2026-01-12'),
(15, 2, 15, '2026-01-13', '2026-01-15'),
(16, 1, 16, '2026-01-18', '2026-01-21'),
(17, 1, 17, '2026-01-11', '2026-01-15'),
(18, 1, 18, '2026-01-02', '2026-01-06'),
(19, 1, 19, '2026-01-09', '2026-01-12'),
(20, 4, 20, '2026-01-03', '2026-01-06'),
(21, 2, 21, '2026-01-02', '2026-01-08'),
(22, 1, 22, '2026-01-16', '2026-01-19'),
(23, 3, 23, '2026-01-14', '2026-01-18'),
(24, 3, 24, '2026-01-07', '2026-01-15'),
(25, 1, 25, '2026-01-17', '2026-01-21'),
(26, 2, 26, '2026-01-05', '2026-01-12'),
(27, 1, 27, '2026-01-07', '2026-01-10'),
(28, 2, 28, '2026-01-06', '2026-01-09'),
(29, 3, 29, '2026-01-08', '2026-01-11');

INSERT INTO ProductPerMagazijn (Id, ProductId, MagazijnId, Locatie) VALUES
(1, 1, 1, 'Berlicum'),
(2, 2, 2, 'Rosmalen'),
(3, 3, 3, 'Berlicum'),
(4, 4, 4, 'Berlicum'),
(5, 5, 5, 'Rosmalen'),
(6, 6, 6, 'Berlicum'),
(7, 7, 7, 'Rosmalen'),
(8, 8, 8, 'Sint-MichelsGestel'),
(9, 9, 9, 'Sint-MichelsGestel'),
(10, 10, 10, 'Middelrode'),
(11, 11, 11, 'Middelrode'),
(12, 12, 12, 'Middelrode'),
(13, 13, 13, 'Schijndel'),
(14, 14, 14, 'Schijndel'),
(15, 15, 15, 'Gemonde'),
(16, 16, 16, 'Gemonde'),
(17, 17, 17, 'Gemonde'),
(18, 18, 18, 'Gemonde'),
(19, 19, 19, 'Den Bosch'),
(20, 20, 20, 'Den Bosch'),
(21, 21, 21, 'Den Bosch'),
(22, 22, 22, 'Heeswijk Dinther'),
(23, 23, 23, 'Heeswijk Dinther'),
(24, 24, 24, 'Heeswijk Dinther'),
(25, 25, 25, 'Vught'),
(26, 26, 26, 'Vught'),
(27, 27, 27, 'Vught'),
(28, 28, 28, 'Vught'),
(29, 29, 29, 'Vught');

SET FOREIGN_KEY_CHECKS = 1;
COMMIT;
