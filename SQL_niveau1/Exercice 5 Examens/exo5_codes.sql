/*1. La liste des stagiaires ;*/
SELECT * FROM stagiaires

/*2. La liste des examens ;*/
SELECT * FROM examens

/*3. Les numéros de tous les stagiaires ;*/
SELECT NumS FROM stagiaires

/*4. Les numéros des examens munis de la date de réalisation ;*/
SELECT NumE, date FROM examens

/*5. La liste des stagiaires triée par nom dans un ordre décroissant ;*/
SELECT Noms FROM stagiaires
ORDER BY NomS asc

/*6. La liste des examens réalisés dans les salles 'A2' ou 'A3';*/
SELECT * FROM examens
WHERE Salle = 'A1' or Salle = 'A2'

/*7. La liste des examens pratiques ;*/
SELECT * FROM examens
WHERE TypeE = 'p'

/*8. La liste précédente triée par date de passation de l'examen ;*/
SELECT * FROM examens
WHERE TypeE = 'p'
ORDER BY DATE ASC

/*9. La liste des examens triée par salle dans un ordre croissant et par date dans un
ordre décroissant ;*/
SELECT * FROM examens
ORDER BY Salle ASC

SELECT * FROM examens
ORDER BY date DESC

/*10. Les numéros et les notes des examens passé par le stagiaire 'S01';*/
SELECT NumE, note FROM passerexamen
WHERE NumS = 'S01'

/*11. Les numéros et les notes des examens passé par le stagiaire 'S01' et dont la
note est supérieure ou égale à 12 ;*/
SELECT NumE, note FROM passerexamen
WHERE NumS = 'S01' AND note > 12

/*12. Les stagiaires dont le nom contient la lettre 'e' ;*/
SELECT * FROM stagiaires
WHERE NomS LIKE '%e%'

/*13. Les prénoms des stagiaires dont le prénom se termine par la lettre 's' ;*/
SELECT PrenomS FROM stagiaires
WHERE PrenomS LIKE '%s'

/*14. Les prénoms des stagiaires dont le prénom se termine par la lettre 's' ou 'd' ;*/
SELECT PrenomS FROM stagiaires
WHERE PrenomS LIKE '%s' OR PrenomS LIKE 'd%' /*?*/

/*15. Les noms et prénoms des stagiaires dont le nom se termine par la lettre 'e' et le
prénom par 's' ;*/
SELECT PrenomS, NomS FROM stagiaires
WHERE PrenomS LIKE '%s' AND NomS LIKE 'e%' /*?*/

/*16. Les noms des stagiaires dont la deuxième lettre est 'a' ;*/
SELECT  NomS FROM stagiaires
WHERE NomS LIKE '_a%' 

/*17. Les noms des stagiaires dont la deuxième lettre n'est pas 'a' ;*/
SELECT  NomS FROM stagiaires
WHERE NomS not LIKE '_a%' 

/*18. La liste des examens pratiques réalisés dans une salle commençant par la lettre
'A';*/
SELECT  NumE FROM examens
WHERE Salle LIKE 'a%' 

/*19. Toutes les salles dont on a réalisé au moins un examen ;*/
SELECT  Salle FROM examens

/*20. La liste précédente mais sans doublons ;*/
SELECT  distinct Salle FROM examens/*Bonne facon*/

SELECT  Salle FROM examens
GROUP BY Salle


/*21. Pour chaque examen, la meilleure et la plus mauvaise note ;*/
SELECT NumE, MAX(note), MIN(note) FROM passerexamen
GROUP BY NumE

/*22. Pour l'examen 'E05', la meilleure et la plus mauvaise note ;*/
SELECT NumE, MAX(note), MIN(note) FROM passerexamen
WHERE NumE ='E05'

/*23. Pour chaque examen, l'écart entre la meilleure et la plus mauvaise note ;*/
SELECT NumE, MAX(note) - MIN(note) 'ecart' FROM passerexamen
GROUP BY NumE

/*24. Le nombre 'examens pratiques (typeE = « P »);*/
SELECT COUNT(*) FROM examens
WHERE TypeE = 'p'

/*25. La date du premier examen effectué ;*/
SELECT  MIN(DATE) FROM examens

/*26. Le nombre de stagiaires dont le nom contient 'r' ou 's' ;*/
SELECT COUNT(NumS) FROM stagiaires
WHERE NomS LIKE '%[rs]%'


/*27. Pour chaque stagiaires la meilleure note dans tous les examens ;*/
SELECT NumS, MAX(note) FROM passerexamen
GROUP BY NumS

/*28. Pour chaque date enregistrée dans la base de données le nombre d'examens ;*/
SELECT DATE, COUNT(NumE) FROM examens
GROUP BY date

/*29. Pour chaque salle le nombre d'examens réalisés ;*/
SELECT Salle, COUNT(NumE) FROM examens
GROUP BY Salle

/*30. Le nombre d'examens réalisés dans la salle ‘A1’;*/
SELECT Salle, COUNT(NumE) FROM examens
WHERE Salle = 'a1'


/*31. Toutes les salles dans lesquelles on a effectué au moins deux examens ;*/
SELECT Salle, COUNT(NumE) AS nrDeExam FROM examens
GROUP BY Salle 
HAVING nrDeExam >= 2

/*32. Toutes les salles dans lesquelles on a effectué exactement 3 examens ;*/
SELECT Salle, COUNT(NumE) AS nrDeExam FROM examens
GROUP BY Salle 
HAVING nrDeExam = 3

/*33. Le nombre d'examens réalisés dans les salles commençant par la lettre 'A' ;*/
SELECT Salle, COUNT(NumE) AS nrDeExam FROM examens
WHERE Salle LIKE 'a%' /*?*/

/*34. Pour chaque salle commençant par la lettre 'A', le nombre d'examens ;*/
SELECT Salle, COUNT(NumE) AS nrDeExam FROM examens
WHERE Salle LIKE 'a%'
GROUP BY Salle 

/*35. Les salles qui commencent par 'A' et dans lesquelles on a effectué deux
examens.*/
SELECT Salle, COUNT(NumE) AS nrDeExam FROM examens
GROUP BY salle
WHERE Salle LIKE 'a%'
HAVING COUNT(*) = 2 /*?*/
