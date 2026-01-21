-- Testdata (Voedselpakketten)
-- Let op: deze inserts zijn een subset die 1-op-1 aansluit op `database/createscript/script.sql`.
-- Bedoeld voor een database waar de tabellen al bestaan (via script.sql).

INSERT INTO Eetwens (Id, Naam, Omschrijving) VALUES
(1, 'GeenVarken', 'Geen Varkensvlees'),
(2, 'Veganistisch', 'Geen zuivelproducten en vlees'),
(3, 'Vegetarisch', 'Geen vlees'),
(4, 'Omnivoor', 'Geen beperkingen');

INSERT INTO Gezin (Id, Naam, Code, Omschrijving, AantalVolwassenen, AantalKinderen, AantalBabys, TotaalAantalPersonen) VALUES
(1, 'ZevenhuizenGezin', 'G0001', 'Bijstandsgezin', 2, 2, 0, 4),
(2, 'BergkampGezin', 'G0002', 'Bijstandsgezin', 2, 1, 1, 4);

INSERT INTO Persoon (Id, GezinId, Voornaam, Tussenvoegsel, Achternaam, Geboortedatum, TypePersoon, IsVertegenwoordiger) VALUES
(4, 1, 'Johan', 'van', 'Zevenhuizen', '1990-05-20', 'Klant', 1),
(8, 2, 'Arjan', NULL, 'Bergkamp', '1968-07-12', 'Klant', 1);

INSERT INTO EetwensPerGezin (Id, GezinId, EetwensId) VALUES
(1, 1, 2),
(2, 2, 4);

INSERT INTO Voedselpakket (Id, GezinId, PakketNummer, DatumSamenstelling, DatumUitgifte, Status) VALUES
(1, 1, 1, '2026-01-21', '2026-01-21', 'Uitgereikt'),
(2, 1, 2, '2026-01-19', NULL, 'NietUitgereikt'),
(3, 1, 3, '2026-01-17', NULL, 'NietMeerIngeschreven'),
(4, 2, 4, '2026-01-10', '2026-01-14', 'Uitgereikt'),
(5, 2, 5, '2026-01-18', '2026-01-20', 'Uitgereikt'),
(6, 2, 6, '2026-01-08', NULL, 'NietUitgereikt');

-- Alleen nodig voor 'Aantal producten' kolom.
-- (Gebaseerd op script.sql; uniek aantal producten per pakket wordt berekend.)
INSERT INTO Product (Id, CategorieId, Naam, SoortAllergie, Barcode, Houdbaarheidsdatum, Omschrijving, Status) VALUES
(6, 1, 'Banaan', 'Banaan', '8719484321336', '2026-02-12', 'Biologische Banaan', 'OverHoudbaarheidsDatum'),
(7, 1, 'Banaan', 'Banaan', '8719484321336', '2026-02-19', 'Biologische Banaan', 'OverHoudbaarheidsDatum'),
(8, 2, 'Kaas', 'Lactose', '8719487421338', '2026-02-19', 'Jonge Kaas', 'OpVoorraad'),
(9, 2, 'Rosbief', NULL, '8719487421331', '2026-02-23', 'Rundvlees', 'OpVoorraad'),
(12, 3, 'Ei', 'Eier', '8719487421334', '2026-02-04', 'Scharrelei', 'OpVoorraad'),
(13, 4, 'Brood', 'Gluten', '8719487721337', '2026-02-07', 'Volkoren brood', 'OpVoorraad'),
(19, 6, 'Pasta', 'Gluten', '8719487321334', '2026-02-16', 'Macaroni', 'NietLeverbaar'),
(20, 6, 'Rijst', NULL, '8719487331332', '2026-02-25', 'Basmati Rijst', 'OpVoorraad'),
(21, 6, 'Knorr Nasi Mix', NULL, '871948735135', '2026-02-13', 'Nasi kruiden', 'OpVoorraad'),
(24, 7, 'Peterselie', NULL, '8719487321636', '2026-02-31', 'Verse kruidenpot', 'OpVoorraaad'),
(25, 8, 'Olie', NULL, '8719487327337', '2026-02-27', 'Olijfolie', 'OpVoorraad'),
(26, 8, 'Mars', NULL, '8719487324334', '2026-02-11', 'Snoep', 'OpVoorraad'),
(27, 8, 'Biscuit', NULL, '8719487311331', '2026-02-07', 'San Francisco biscuit', 'OpVoorraad');

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

