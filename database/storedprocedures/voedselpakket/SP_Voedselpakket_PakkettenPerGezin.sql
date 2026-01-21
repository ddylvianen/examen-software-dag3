-- Stored Procedure: SP_Voedselpakket_PakkettenPerGezin
-- Doel: Lijst voedselpakketten voor 1 gezin (Wireframe-03: Overzicht Voedselpakketten)
-- Gebruikte tabellen: Voedselpakket, ProductPerVoedselpakket

DROP PROCEDURE IF EXISTS SP_Voedselpakket_PakkettenPerGezin;
DELIMITER $$
CREATE PROCEDURE SP_Voedselpakket_PakkettenPerGezin(IN pGezinId INT UNSIGNED)
BEGIN
    SELECT
        v.Id AS VoedselpakketId,
        v.GezinId,
        v.PakketNummer,
        v.DatumSamenstelling,
        v.DatumUitgifte,
        v.Status,
        COALESCE(COUNT(DISTINCT ppv.ProductId), 0) AS AantalProducten
    FROM Voedselpakket v
    LEFT JOIN ProductPerVoedselpakket ppv
        ON ppv.VoedselpakketId = v.Id
        AND ppv.IsActief = 1
    WHERE v.GezinId = pGezinId
      AND v.IsActief = 1
    GROUP BY
        v.Id,
        v.GezinId,
        v.PakketNummer,
        v.DatumSamenstelling,
        v.DatumUitgifte,
        v.Status
    ORDER BY v.PakketNummer ASC;
END$$
DELIMITER ;

