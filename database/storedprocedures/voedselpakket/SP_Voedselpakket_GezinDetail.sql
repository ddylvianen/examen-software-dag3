-- Stored Procedure: SP_Voedselpakket_GezinDetail
-- Doel: Gezinsdetails voor pagina 'Overzicht Voedselpakketten' (Wireframe-03)
-- Gebruikte tabellen: Gezin

DROP PROCEDURE IF EXISTS SP_Voedselpakket_GezinDetail;
DELIMITER $$
CREATE PROCEDURE SP_Voedselpakket_GezinDetail(IN pGezinId INT UNSIGNED)
BEGIN
    SELECT
        g.Id AS GezinId,
        g.Naam,
        g.Omschrijving,
        g.TotaalAantalPersonen
    FROM Gezin g
    WHERE g.Id = pGezinId
      AND g.IsActief = 1
    LIMIT 1;
END$$
DELIMITER ;

