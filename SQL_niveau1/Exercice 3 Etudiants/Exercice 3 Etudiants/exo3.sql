/*question 1 - Afficher la liste des étudiants triés par ordre croissant de date
 de naissance */
SELECT nom, prenom, date_naissance 
FROM etudiant
ORDER BY date_naissance asc

/*question 2 - Afficher tous les étudiants inscrits à M1 et tous les étudiants 
inscrits à M2.*/
SELECT nom, prenom FROM etudiant
WHERE niveau = 'M1' OR 'M2'

/*question 3 - Afficher les matricules des étudiants qui ont passé l'examen du cours 002.*/
SELECT matricule FROM examen
where code = '002'


/*question 4 - Afficher les matricules de tous les étudiants qui ont passé l'examen du cours 001 et
de tous les étudiants qui ont passé l'examen du cours 002.*/
SELECT matricule FROM examen
WHERE code = '001' AND CODE = '002'

/*question 5 - Afficher le matricule, code, note /20 et note /40 de tous les examens classés par
ordre croissant de matricule et de code.*/
SELECT matricule, CODE, note AS 'note sur 20', note*2 AS 'note sur 40'
FROM examen
ORDER BY matricule, code desc

/*question 6 - Trouver la moyenne de notes de cours 002.*/
SELECT AVG(note) FROM examen 
WHERE CODE = 002

/*question 7 - Compter les examens passés par un étudiant (exemple avec matricule 'e001')*/
SELECT COUNT(CODE) AS 'examens' FROM EXAMEN
WHERE matricule = 'e001'


/*question 8 - Compter le nombre d'étudiants qui ont passé l'examen du cours 002.*/
SELECT COUNT(matricule) AS 'eleves' FROM EXAMEN
WHERE code = '002'

/*question 9 - Calculer la moyenne des notes d'un étudiant (exemple avec matricule 'e001').*/
SELECT AVG(NOTE) FROM EXAMEN
WHERE matricule = 'e001'

/*question 10 - Compter les examens passés par chaque étudiant.*/
SELECT matricule, count(CODE) AS examens FROM EXAMEN
GROUP BY matricule


/*question 11 - Calculer la moyenne des notes pour chaque étudiant.*/
SELECT matricule, avg(note) AS moy_examens FROM EXAMEN
GROUP BY matricule

/*question 12 - .Même question, mais afficher seulement les étudiants (et leurs moyennes) dont la
moyenne est >= 15.*/
SELECT matricule, avg(note) AS moy_examens FROM EXAMEN
GROUP BY matricule
HAVING AVG(note) >= 15


/*question 13 - .Trouver la moyenne de notes de chaque cours.*/
SELECT code, avg(note) AS moy_examens FROM EXAMEN
GROUP BY code
