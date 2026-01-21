-- Stored Procedure: SP_Voedselpakket_UpdateStatus
-- Doel: Status van een voedselpakket wijzigen met business rules (Wireframe-04/05/06)
-- Gebruikte tabellen: Voedselpakket
--
-- Rules:
-- - Als status 'NietMeerIngeschreven' is, dan geen update (melding teruggeven).
-- - Bij wijzigen naar 'Uitgereikt' -> DatumUitgifte wordt vandaag.
-- - Bij wijzigen naar 'NietUitgereikt' -> DatumUitgifte wordt NULL.

DROP PROCEDURE IF EXISTS SP_Voedselpakket_UpdateStatus;
DELIMITER $$
CREATE PROCEDURE SP_Voedselpakket_UpdateStatus(
    IN pVoedselpakketId INT UNSIGNED,
    IN pNieuweStatus VARCHAR(50)
)
BEGIN
    DECLARE vHuidigeStatus VARCHAR(50);
    DECLARE vGezinId INT UNSIGNED;

    SELECT v.Status, v.GezinId
      INTO vHuidigeStatus, vGezinId
    FROM Voedselpakket v
    WHERE v.Id = pVoedselpakketId
      AND v.IsActief = 1
    LIMIT 1;

    IF vHuidigeStatus IS NULL THEN
        SELECT
            0 AS ResultCode,
            'Voedselpakket niet gevonden' AS Message,
            NULL AS GezinId;
    ELSEIF vHuidigeStatus = 'NietMeerIngeschreven' THEN
        SELECT
            0 AS ResultCode,
            'Dit gezin is niet meer ingeschreven bij de voedselbank en daarom kan er geen voedselpakket worden uitgereikt' AS Message,
            vGezinId AS GezinId;
    ELSE
        IF pNieuweStatus = 'Uitgereikt' THEN
            UPDATE Voedselpakket
            SET Status = pNieuweStatus,
                DatumUitgifte = CURRENT_DATE()
            WHERE Id = pVoedselpakketId
              AND IsActief = 1;
        ELSE
            UPDATE Voedselpakket
            SET Status = pNieuweStatus,
                DatumUitgifte = NULL
            WHERE Id = pVoedselpakketId
              AND IsActief = 1;
        END IF;

        SELECT
            1 AS ResultCode,
            'De wijziging is doorgevoerd' AS Message,
            vGezinId AS GezinId;
    END IF;
END$$
DELIMITER ;

