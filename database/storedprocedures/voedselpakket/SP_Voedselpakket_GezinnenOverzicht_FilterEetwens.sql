-- Stored Procedure: SP_Voedselpakket_GezinnenOverzicht_FilterEetwens
-- Doel: Overzicht gezinnen met voedselpakketten, gefilterd op eetwens (Wireframe-03/04)
-- Gebruikte tabellen: Gezin, Persoon, Voedselpakket, EetwensPerGezin, Eetwens

DROP PROCEDURE IF EXISTS SP_Voedselpakket_GezinnenOverzicht_FilterEetwens;
DELIMITER $$
CREATE PROCEDURE SP_Voedselpakket_GezinnenOverzicht_FilterEetwens(IN pEetwensId INT UNSIGNED)
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
    INNER JOIN Voedselpakket v
        ON v.GezinId = g.Id
        AND v.IsActief = 1
    INNER JOIN EetwensPerGezin epg
        ON epg.GezinId = g.Id
        AND epg.IsActief = 1
        AND epg.EetwensId = pEetwensId
    INNER JOIN Eetwens e
        ON e.Id = epg.EetwensId
        AND e.IsActief = 1
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

