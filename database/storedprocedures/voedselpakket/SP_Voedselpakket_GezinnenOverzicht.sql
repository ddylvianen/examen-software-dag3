-- Stored Procedure: SP_Voedselpakket_GezinnenOverzicht
-- Doel: Overzicht gezinnen met voedselpakketten (Wireframe-02)
-- Gebruikte tabellen: Gezin, Persoon, Voedselpakket

DROP PROCEDURE IF EXISTS SP_Voedselpakket_GezinnenOverzicht;
DELIMITER $$
CREATE PROCEDURE SP_Voedselpakket_GezinnenOverzicht()
BEGIN
    SELECT
        g.Id AS GezinId,
        g.Naam AS Gezinsnaam,
        g.Omschrijving,
        g.AantalVolwassenen,
        g.AantalKinderen,
        g.AantalBabys,
        CONCAT_WS(' ', p.Voornaam, p.Tussenvoegsel, p.Achternaam) AS Vertegenwoordiger
    FROM Gezin g
    LEFT JOIN Persoon p
        ON p.GezinId = g.Id
        AND p.IsVertegenwoordiger = 1
        AND p.IsActief = 1
    WHERE g.IsActief = 1
    GROUP BY
        g.Id,
        g.Naam,
        g.Omschrijving,
        g.AantalVolwassenen,
        g.AantalKinderen,
        g.AantalBabys,
        p.Voornaam,
        p.Tussenvoegsel,
        p.Achternaam
    ORDER BY g.Naam ASC;
END$$
DELIMITER ;

