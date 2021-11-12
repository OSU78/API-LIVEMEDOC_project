
DROP DATABASE livmedoc ; 
CREATE DATABASE livmedoc ;
USE livmedoc ;

create table utilisateur
(idU int(3) not null auto_increment,
nom varchar(50) not null,
prenom varchar(50),
sexe varchar(15),
adresse varchar(100),
ville varchar(50),
codepostal int(3),
email varchar(50),
mdp varchar(25),
primary key(idU)
)engine=InnoDB;



create table medecin
(
idM int(3) not null auto_increment,
primary key(idM),
foreign key(idM) references utilisateur(idU) ON DELETE CASCADE
)engine=InnoDB;




create table livreur
(
idL int(3) not null auto_increment,
primary key(idL),
foreign key(idL) references utilisateur(idU) ON DELETE CASCADE
)engine=InnoDB;


create table allergie
(
idAl int(3) not null auto_increment,
libelle varchar(50),
primary key(idAl)
)engine=InnoDB;






create table traitement
(
idT int(3) not null auto_increment,
libelle varchar(50),
primary key(idT)
)engine=InnoDB;






create table assurancemaladie
(
idAs int(3) not null auto_increment,
libelle varchar(50),
primary key(idAs)
)engine=InnoDB;



create table patient
(
idPa int(3) not null auto_increment,
age int(3),
enceinte boolean,
allaitement boolean,
idAs int(3),
primary key(idPa),
foreign key(idPa) references utilisateur(idU) ON DELETE CASCADE,
foreign key(idAs) references assurancemaladie(idAs) ON DELETE CASCADE
)engine=InnoDB;



create table posséder_traitement
(
idT int(3) not null,
idPa int(3) not null,
primary key(idT,idPa),
foreign key(idT) references traitement(idT) ON DELETE CASCADE,
foreign key(idPa) references patient(idPa) ON DELETE CASCADE
)engine=InnoDB;

create table avoir_allergie
(
idAl int(3) not null,
idPa int(3) not null,
primary key(idAl,idPa),
foreign key(idAl) references allergie(idAl) ON DELETE CASCADE,
foreign key(idPa) references patient(idPa) ON DELETE CASCADE
... (243 lignes restantes)
Réduire
Script_mysql.txt
7 Ko
OSU s.o — Aujourd’hui à 17:47
thankks
CaRe — Aujourd’hui à 17:47
non tkt y'a pas grand chose à changer
je t'envoie la classe aussi
voila
<?php


class Ordonnance {   		
      	private static $idO ;
        private static $dateordo ;
Afficher plus
class.ordonnance.php
2 Ko
normalement c'est bon
OSU s.o — Aujourd’hui à 17:50
merci je vais edit
﻿
DROP DATABASE livmedoc ; 
CREATE DATABASE livmedoc ;
USE livmedoc ;

create table utilisateur
(idU int(3) not null auto_increment,
nom varchar(50) not null,
prenom varchar(50),
sexe varchar(15),
adresse varchar(100),
ville varchar(50),
codepostal int(3),
email varchar(50),
mdp varchar(25),
primary key(idU)
)engine=InnoDB;



create table medecin
(
idM int(3) not null auto_increment,
primary key(idM),
foreign key(idM) references utilisateur(idU) ON DELETE CASCADE
)engine=InnoDB;




create table livreur
(
idL int(3) not null auto_increment,
primary key(idL),
foreign key(idL) references utilisateur(idU) ON DELETE CASCADE
)engine=InnoDB;


create table allergie
(
idAl int(3) not null auto_increment,
libelle varchar(50),
primary key(idAl)
)engine=InnoDB;






create table traitement
(
idT int(3) not null auto_increment,
libelle varchar(50),
primary key(idT)
)engine=InnoDB;






create table assurancemaladie
(
idAs int(3) not null auto_increment,
libelle varchar(50),
primary key(idAs)
)engine=InnoDB;



create table patient
(
idPa int(3) not null auto_increment,
age int(3),
enceinte boolean,
allaitement boolean,
idAs int(3),
primary key(idPa),
foreign key(idPa) references utilisateur(idU) ON DELETE CASCADE,
foreign key(idAs) references assurancemaladie(idAs) ON DELETE CASCADE
)engine=InnoDB;



create table posséder_traitement
(
idT int(3) not null,
idPa int(3) not null,
primary key(idT,idPa),
foreign key(idT) references traitement(idT) ON DELETE CASCADE,
foreign key(idPa) references patient(idPa) ON DELETE CASCADE
)engine=InnoDB;

create table avoir_allergie
(
idAl int(3) not null,
idPa int(3) not null,
primary key(idAl,idPa),
foreign key(idAl) references allergie(idAl) ON DELETE CASCADE,
foreign key(idPa) references patient(idPa) ON DELETE CASCADE
)engine=InnoDB;

create table ordonnance
(
idO int(3) not null auto_increment,
dateordo date,
photo varchar(100),
contenu varchar(250),
idPa int(3),
idM int(3),
primary key(idO),
foreign key(idPa) references patient(idPa) ON DELETE CASCADE,
foreign key(idM) references medecin(idM) ON DELETE CASCADE
)engine=InnoDB;



create table medicament
(
idMe int(3) not null auto_increment,
libelle varchar(50),
photo varchar(100),
description varchar(500),
primary key(idMe)
)engine=InnoDB;


create table correspondre_medicament
(
idO int(3) not null,
idMe int(3) not null,
primary key(idO,idMe),
foreign key(idO) references ordonnance(idO) ON DELETE CASCADE,
foreign key(idMe) references medicament(idMe) ON DELETE CASCADE
)engine=InnoDB;


create table notice
(
idNo int(3) not null auto_increment,
description varchar(250),
idMe int(3),
primary key(idNo),
foreign key(idMe) references medicament(idMe) ON DELETE CASCADE
)engine=InnoDB;



create table pharmacie
(
idPha int(3) not null auto_increment,
nom varchar(250),
adresse varchar(250),
codepostal int(3),
ville varchar(100),
horaireouverture int(3),
horairefermeture int(3),
primary key(idPha)
)engine=InnoDB;



create table pharmacien
(
idPh int(3) not null auto_increment,
idPha int(3),
primary key(idPh),
foreign key(idPh) references utilisateur(idU) ON DELETE CASCADE,
foreign key(idPha) references pharmacie(idPha) ON DELETE CASCADE
)engine=InnoDB;


create table choisir_pharmacie
(
idPa int(3) not null,
idPha int(3) not null,
primary key(idPa,idPha),
foreign key(idPa) references patient(idPa) ON DELETE CASCADE,
foreign key(idPha) references pharmacie(idPha) ON DELETE CASCADE
)engine=InnoDB;



create table produit
(
idPo int(3) not null auto_increment,
libelle varchar(50),
photo varchar(250),
description varchar(400),
idPha int(3),
primary key(idPo),
foreign key(idPha) references pharmacie(idPha) ON DELETE CASCADE
)engine=InnoDB;



create table commande
(
idCo int(3) not null auto_increment,
datelivraison date,
horairelivraison varchar(100),
modulepaiement varchar(200),
primary key(idCo)
)engine=InnoDB;



create table comporter_medicament
(
idMe int(3) not null,
idCo int(3) not null,
primary key(idMe,idCo),
foreign key(idMe) references medicament(idMe) ON DELETE CASCADE,
foreign key(idCo) references commande(idCo) ON DELETE CASCADE
)engine=InnoDB;



create table avoir_produit
(
idPo int(3) not null,
idMe int(3) not null,
primary key(idPo,idMe),
foreign key(idPo) references produit(idPo) ON DELETE CASCADE,
foreign key(idMe) references medicament(idMe) ON DELETE CASCADE
)engine=InnoDB;




create table suivre_commande
(
idPh int(3) not null,
idCo int(3) not null,
primary key(idPh,idCo),
foreign key(idPh) references pharmacien(idPh) ON DELETE CASCADE,
foreign key(idCo) references commande(idCo) ON DELETE CASCADE
)engine=InnoDB;



create table livrer_commande
(
idL int(3) not null,
idCo int(3) not null,
primary key(idL,idCo),
foreign key(idL) references livreur(idL) ON DELETE CASCADE,
foreign key(idCo) references commande(idCo) ON DELETE CASCADE
)engine=InnoDB;



insert into utilisateur values 
(null,'Dupont','Julien','homme','32 rue Convention','Paris',75015,'j.dupont@gmail.com','abcd1234'),
(null,'Richard','Jean','homme','3 rue Vaugirard','Paris', 75015,'j.richard@gmail.com','abcd1234'),
(null,'Marchand','Carole','femme','12 rue Cauchy','Paris',75015,'c.marchand@hotmail.com','abcd1234'),
(null,'Martel','Georges','homme','2 rue Borromée','Paris',75015,'g.martel@gmail.com','abcd1234');


insert into medecin values 
(2);


insert into livreur values 
(4);


insert into allergie values 
(null,'acariens');






insert into traitement values 
(null,'antihistaminique');





insert into assurancemaladie values 
(null,'ameli');


insert into patient values 
(1,35,false,false,1);


insert into avoir_allergie values 
(1,1);

insert into posséder_traitement values 
(1,1);

insert into ordonnance values 
(null,'2021-04-30','ordonnance.jpg','antihistaminique 2 boites',1,2);


insert into medicament values 
(null,'doliprane','doliprane.jpg','antalgique et antipyrétique');


insert into correspondre_medicament values 
(1,1);

insert into notice values 
(null,'noticedoliprane.pdf',1);


insert into pharmacie values 
(null,'Pharmacie Lourmel','105 avenue Félix Faure',75015,'Paris',10,19);


insert into pharmacien values 
(3,1);




insert into produit values 
(null,'masque FFP2','masque.jpg','modèle de masque de protection autofiltrant de type jetable',1);


insert into commande values 
(null,'2021/05/10','10h - 14h','PayPal');


insert into comporter_medicament values 
(1,1);

insert into avoir_produit values 
(1,1);


insert into suivre_commande values 
(3,1);


insert into livrer_commande values 
(4,1);