SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO,ALLOW_INVALID_DATES";
START TRANSACTION;
SET time_zone = "+00:00";

USE Voedselbank2;

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
    Voedselpakket,
    Product,
    Persoon,
    Magazijn,
    Leverancier,
    Gezin,
    Eetwens,
    Contact,
    Categorie,
    Rol,
    Allergie,
    users;

-- --------------------------------------------------------
-- BASIS TABELLEN
-- --------------------------------------------------------

CREATE TABLE Allergie (
    Id INT UNSIGNED PRIMARY KEY,
    Naam VARCHAR(255) NOT NULL,
    Omschrijving VARCHAR(255) NOT NULL,
    AnafylactischRisico VARCHAR(50),
    IsActief BIT(1) DEFAULT 1,
    Opmerking VARCHAR(255),
    DatumAangemaakt DATETIME DEFAULT CURRENT_TIMESTAMP,
    DatumGewijzigd DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE Rol (
    Id INT UNSIGNED PRIMARY KEY,
    Naam VARCHAR(255) NOT NULL,
    IsActief BIT(1) DEFAULT 1,
    Opmerking VARCHAR(255),
    DatumAangemaakt DATETIME DEFAULT CURRENT_TIMESTAMP,
    DatumGewijzigd DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE Categorie (
    Id INT UNSIGNED PRIMARY KEY,
    Naam VARCHAR(255) NOT NULL,
    Omschrijving VARCHAR(255) NOT NULL,
    IsActief BIT(1) DEFAULT 1,
    Opmerking VARCHAR(255),
    DatumAangemaakt DATETIME DEFAULT CURRENT_TIMESTAMP,
    DatumGewijzigd DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE Contact (
    Id INT UNSIGNED PRIMARY KEY,
    Straat VARCHAR(255) NOT NULL,
    Huisnummer INT NOT NULL,
    Toevoeging VARCHAR(10),
    Postcode VARCHAR(10) NOT NULL,
    Woonplaats VARCHAR(255) NOT NULL,
    Email VARCHAR(255) NOT NULL,
    Mobiel VARCHAR(20) NOT NULL,
    IsActief BIT(1) DEFAULT 1,
    Opmerking VARCHAR(255),
    DatumAangemaakt DATETIME DEFAULT CURRENT_TIMESTAMP,
    DatumGewijzigd DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE Eetwens (
    Id INT UNSIGNED PRIMARY KEY,
    Naam VARCHAR(255) NOT NULL,
    Omschrijving VARCHAR(255) NOT NULL,
    IsActief BIT(1) DEFAULT 1,
    Opmerking VARCHAR(255),
    DatumAangemaakt DATETIME DEFAULT CURRENT_TIMESTAMP,
    DatumGewijzigd DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE Gezin (
    Id INT UNSIGNED PRIMARY KEY,
    Naam VARCHAR(255) NOT NULL,
    Code VARCHAR(50) NOT NULL,
    Omschrijving VARCHAR(255),
    AantalVolwassenen INT NOT NULL,
    AantalKinderen INT NOT NULL,
    AantalBabys INT NOT NULL,
    TotaalAantalPersonen INT NOT NULL,
    IsActief BIT(1) DEFAULT 1,
    Opmerking VARCHAR(255),
    DatumAangemaakt DATETIME DEFAULT CURRENT_TIMESTAMP,
    DatumGewijzigd DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE Leverancier (
    Id INT UNSIGNED PRIMARY KEY,
    Naam VARCHAR(255) NOT NULL,
    ContactPersoon VARCHAR(255) NOT NULL,
    LeverancierNummer VARCHAR(50) NOT NULL,
    LeverancierType VARCHAR(50) NOT NULL,
    IsActief BIT(1) DEFAULT 1,
    Opmerking VARCHAR(255),
    DatumAangemaakt DATETIME DEFAULT CURRENT_TIMESTAMP,
    DatumGewijzigd DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE Magazijn (
    Id INT UNSIGNED PRIMARY KEY,
    Ontvangstdatum DATE NOT NULL,
    Uitleveringsdatum DATE,
    VerpakkingsEenheid VARCHAR(50) NOT NULL,
    Aantal INT NOT NULL,
    IsActief BIT(1) DEFAULT 1,
    Opmerking VARCHAR(255),
    DatumAangemaakt DATETIME DEFAULT CURRENT_TIMESTAMP,
    DatumGewijzigd DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE Persoon (
    Id INT UNSIGNED PRIMARY KEY,
    GezinId INT UNSIGNED,
    Voornaam VARCHAR(255) NOT NULL,
    Tussenvoegsel VARCHAR(50),
    Achternaam VARCHAR(255) NOT NULL,
    Geboortedatum DATE NOT NULL,
    TypePersoon VARCHAR(50) NOT NULL,
    IsVertegenwoordiger BIT NOT NULL,
    IsActief BIT(1) DEFAULT 1,
    Opmerking VARCHAR(255),
    DatumAangemaakt DATETIME DEFAULT CURRENT_TIMESTAMP,
    DatumGewijzigd DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_persoon_gezin FOREIGN KEY (GezinId) REFERENCES Gezin(Id)
) ENGINE=InnoDB;

CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    PersoonId INT UNSIGNED,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    IsIngelogd BIT(1) DEFAULT 0,
    Ingelogd DATETIME,
    Uitgelogd DATETIME,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    CONSTRAINT fk_users_persoon FOREIGN KEY (PersoonId) REFERENCES Persoon(Id)
) ENGINE=InnoDB;

CREATE TABLE Product (
    Id INT UNSIGNED PRIMARY KEY,
    CategorieId INT UNSIGNED NOT NULL,
    Naam VARCHAR(255) NOT NULL,
    SoortAllergie VARCHAR(255),
    Barcode VARCHAR(50) NOT NULL,
    Houdbaarheidsdatum DATE NOT NULL,
    Omschrijving VARCHAR(255),
    Status VARCHAR(50) NOT NULL,
    IsActief BIT(1) DEFAULT 1,
    Opmerking VARCHAR(255),
    DatumAangemaakt DATETIME DEFAULT CURRENT_TIMESTAMP,
    DatumGewijzigd DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_product_categorie FOREIGN KEY (CategorieId) REFERENCES Categorie(Id)
) ENGINE=InnoDB;

CREATE TABLE Voedselpakket (
    Id INT UNSIGNED PRIMARY KEY,
    GezinId INT UNSIGNED NOT NULL,
    PakketNummer INT NOT NULL,
    DatumSamenstelling DATETIME NOT NULL,
    DatumUitgifte DATETIME,
    Status VARCHAR(50) NOT NULL,
    IsActief BIT(1) DEFAULT 1,
    Opmerking VARCHAR(255),
    DatumAangemaakt DATETIME DEFAULT CURRENT_TIMESTAMP,
    DatumGewijzigd DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_voedselpakket_gezin FOREIGN KEY (GezinId) REFERENCES Gezin(Id)
) ENGINE=InnoDB;

-- --------------------------------------------------------
-- JUNCTION TABLES MET FK
-- --------------------------------------------------------

CREATE TABLE AllergiePerPersoon (
    Id INT UNSIGNED PRIMARY KEY,
    PersoonId INT UNSIGNED NOT NULL,
    AllergieId INT UNSIGNED NOT NULL,
    CONSTRAINT fk_app_persoon FOREIGN KEY (PersoonId) REFERENCES Persoon(Id),
    CONSTRAINT fk_app_allergie FOREIGN KEY (AllergieId) REFERENCES Allergie(Id)
) ENGINE=InnoDB;

CREATE TABLE RolPerGebruiker (
    Id INT UNSIGNED PRIMARY KEY,
    GebruikerId INT UNSIGNED NOT NULL,
    RolId INT UNSIGNED NOT NULL,
    CONSTRAINT fk_rpg_user FOREIGN KEY (GebruikerId) REFERENCES users(id),
    CONSTRAINT fk_rpg_rol FOREIGN KEY (RolId) REFERENCES Rol(Id)
) ENGINE=InnoDB;

CREATE TABLE ContactPerLeverancier (
    Id INT UNSIGNED PRIMARY KEY,
    LeverancierId INT UNSIGNED NOT NULL,
    ContactId INT UNSIGNED NOT NULL,
    CONSTRAINT fk_cpl_lev FOREIGN KEY (LeverancierId) REFERENCES Leverancier(Id),
    CONSTRAINT fk_cpl_contact FOREIGN KEY (ContactId) REFERENCES Contact(Id)
) ENGINE=InnoDB;

CREATE TABLE ContactPerGezin (
    Id INT UNSIGNED PRIMARY KEY,
    GezinId INT UNSIGNED NOT NULL,
    ContactId INT UNSIGNED NOT NULL,
    CONSTRAINT fk_cpg_gezin FOREIGN KEY (GezinId) REFERENCES Gezin(Id),
    CONSTRAINT fk_cpg_contact FOREIGN KEY (ContactId) REFERENCES Contact(Id)
) ENGINE=InnoDB;

CREATE TABLE EetwensPerGezin (
    Id INT UNSIGNED PRIMARY KEY,
    GezinId INT UNSIGNED NOT NULL,
    EetwensId INT UNSIGNED NOT NULL,
    CONSTRAINT fk_epg_gezin FOREIGN KEY (GezinId) REFERENCES Gezin(Id),
    CONSTRAINT fk_epg_eetwens FOREIGN KEY (EetwensId) REFERENCES Eetwens(Id)
) ENGINE=InnoDB;

CREATE TABLE ProductPerVoedselpakket (
    Id INT UNSIGNED PRIMARY KEY,
    VoedselpakketId INT UNSIGNED NOT NULL,
    ProductId INT UNSIGNED NOT NULL,
    AantalProductEenheden INT NOT NULL,
    CONSTRAINT fk_ppv_pakket FOREIGN KEY (VoedselpakketId) REFERENCES Voedselpakket(Id),
    CONSTRAINT fk_ppv_product FOREIGN KEY (ProductId) REFERENCES Product(Id)
) ENGINE=InnoDB;

CREATE TABLE ProductPerLeverancier (
    Id INT UNSIGNED PRIMARY KEY,
    LeverancierId INT UNSIGNED NOT NULL,
    ProductId INT UNSIGNED NOT NULL,
    DatumAangeleverd DATE NOT NULL,
    DatumEerstVolgendeLevering DATE,
    CONSTRAINT fk_ppl_leverancier FOREIGN KEY (LeverancierId) REFERENCES Leverancier(Id),
    CONSTRAINT fk_ppl_product FOREIGN KEY (ProductId) REFERENCES Product(Id)
) ENGINE=InnoDB;

CREATE TABLE ProductPerMagazijn (
    Id INT UNSIGNED PRIMARY KEY,
    ProductId INT UNSIGNED NOT NULL,
    MagazijnId INT UNSIGNED NOT NULL,
    Locatie VARCHAR(255) NOT NULL,
    CONSTRAINT fk_ppm_product FOREIGN KEY (ProductId) REFERENCES Product(Id),
    CONSTRAINT fk_ppm_magazijn FOREIGN KEY (MagazijnId) REFERENCES Magazijn(Id)
) ENGINE=InnoDB;

SET FOREIGN_KEY_CHECKS = 1;
COMMIT;