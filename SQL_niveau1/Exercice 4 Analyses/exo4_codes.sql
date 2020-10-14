/*1. La base est vierge. Réalisez l'insertion d'un jeu de données dans les différentes
tables. Les données seront définies par vous-même à votre convenance.*/

INSERT INTO CLIENT values(1, 'Pierre', '01000', 'Geneve', '0611111101')
INSERT INTO CLIENT values(2, 'Jean', '02000', 'New York', '0621111102')
INSERT INTO CLIENT values(3, 'Noah', '03000', 'Sao Paulo', '0631111103')
INSERT INTO CLIENT values(4, 'Laurent', '04000', 'Praia', '0641111104')
INSERT INTO CLIENT values(5, 'Sarah', '05000', 'Sidney', '0651111105')

INSERT INTO ECHANTILLON values(1, '2018-01-01',1)
INSERT INTO ECHANTILLON values(2, '2020-08-02',2)
INSERT INTO ECHANTILLON values(3, '2015-12-03',3)
INSERT INTO ECHANTILLON values(4, '2019-03-04',4)
INSERT INTO ECHANTILLON values(5, '2010-10-05',5)

INSERT INTO typeanalyse VALUES(1,11,10)
INSERT INTO typeanalyse VALUES(2,12,20)
INSERT INTO typeanalyse VALUES(3,13,30)
INSERT INTO typeanalyse VALUES(4,14,40)
INSERT INTO typeanalyse VALUES(5,15,50)

INSERT INTO realiser VALUES(1,1,'2020-10-01')
INSERT INTO realiser VALUES(2,2,'2020-10-02')
INSERT INTO realiser VALUES(3,3,'2020-10-03')
INSERT INTO realiser VALUES(4,4,'2020-10-04')
INSERT INTO realiser VALUES(5,5,'2020-10-05')


/*2. Augmentez de 10% tous les prix des analyses.*/
UPDATE typeanalyse 
SET PRIXTYPEANALYSE = PRIXTYPEANALYSE + (PRIXTYPEANALYSE*10/100)

/*3. Il a été défini un prix plancher (prix minimum) de 80 € pour toutes les analyses.
Mettez à jour la table TYPEANALYSE.*/
UPDATE typeanalyse SET PRIXTYPEANALYSE  =	80 /*pas bon encore*/

/*4. Aujourd'hui, toutes les analyses en cours ont été réalisées. Mettez à jour la table
« Réaliser » en mettant la date du jour à toutes les entrées.*/
UPDATE realiser SET daterealisation  =	'2020-10-12'

/*5. Le client dont le code est "c1" vient de fournir son numéro de téléphone
(0611111111). Mettre à jour la table correspondante.*/
UPDATE client SET tel  =	'0611111111' WHERE codeclient =1


/*6. Suite à un bug informatique, des entrées ont été saisies le 01 février 2007 au lieu du
1er février 2006. Mettez à jour la base.*/
UPDATE echantillon SET dateentree  = '2006-02-01' 

/*7. Afin de préparer la nouvelle campagne, de nouvelles analyses ont été définies.
Ces nouvelles analyses sont disponibles dans une table ANALYSECOLYSTEROL
dont la structure (champs, types de donnée) est identique à TYPEANALYSE. Créez
cette nouvelle table, saisissez des données dedans et mettez à jour la
table TYPEANALYSE à partir de la table ANALYSECOLYSTEROL en insérant toutes
les données de cette dernière table dans la première.*/
INSERT INTO analysecolysterol VALUES(1,21,10)
INSERT INTO analysecolysterol VALUES(2,22,20)
INSERT INTO analysecolysterol VALUES(3,23,30)
INSERT INTO analysecolysterol VALUES(4,24,40)
INSERT INTO analysecolysterol VALUES(5,25,50)
