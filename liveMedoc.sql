DROP DATABASE iF EXISTS livmedoc ; 
CREATE DATABASE livmedoc ;
USE livmedoc ;


create table utilisateur
(idU int(9) not null auto_increment,
nom varchar(50) not null,
prenom varchar(50) not null,
sexe varchar(15),
adresse varchar(100),
villeU varchar(50),
codepostalU int(9),
emailU varchar(50),
mdpU varchar(25),
primary key(idU)
)engine=InnoDB;



create table medecin
(
idM int(9) not null auto_increment,
primary key(idM),
foreign key(idM) references utilisateur(idU) ON DELETE CASCADE
)engine=InnoDB;




create table livreur
(
idL int(9) not null auto_increment,
primary key(idL),
foreign key(idL) references utilisateur(idU) ON DELETE CASCADE
)engine=InnoDB;


create table allergie
(
idAl int(9) not null auto_increment,
libelle varchar(50),
primary key(idAl)
)engine=InnoDB;





create table traitement
(
idT int(9) not null auto_increment,
libelleTraitement varchar(55) not null,
primary key(idT)
)engine=InnoDB;




create table assurancemaladie
(
idAs int(9) not null auto_increment,
libelle varchar(50),
primary key(idAs)
)engine=InnoDB;



create table patient
(
idPa int(9) not null auto_increment,
age int(9),
enceinte boolean,
allaitement boolean,
idAs int(9),
primary key(idPa),
foreign key(idPa) references utilisateur(idU) ON DELETE CASCADE,
foreign key(idAs) references assurancemaladie(idAs) ON DELETE CASCADE
)engine=InnoDB;


create table ordonnance
(
idO int(9) not null auto_increment,
dateordo date,
contenu varchar(250),
idPa int(9),
idM int(9),
primary key(idO),
foreign key(idPa) references patient(idPa) ON DELETE CASCADE,
foreign key(idM) references medecin(idM) ON DELETE CASCADE
)engine=InnoDB;



create table medicament
(
idMe int(9) not null auto_increment,
libelle varchar(50),
photo varchar(100),
description varchar(500),
primary key(idMe)
)engine=InnoDB;


create table correspondre_medicament
(
idO int(9) not null,
idMe int(9) not null,
primary key(idO,idMe),
foreign key(idO) references ordonnance(idO) ON DELETE CASCADE,
foreign key(idMe) references medicament(idMe) ON DELETE CASCADE
)engine=InnoDB;


create table notice
(
idNo int(9) not null auto_increment,
description varchar(250),
idMe int(9),
primary key(idNo),
foreign key(idMe) references medicament(idMe) ON DELETE CASCADE
)engine=InnoDB;



create table pharmacie
(
idPha int(9) not null auto_increment,
nom varchar(250),
adresse varchar(250),
codepostal int(9),
ville varchar(100),
horaireouverture int(9),
horairefermeture int(9),
primary key(idPha)
)engine=InnoDB;



create table pharmacien
(
idPh int(9) not null,
idPha int(9) not null,
primary key(idPh),
foreign key(idPh) references utilisateur(idU) ON DELETE CASCADE,
foreign key(idPha) references pharmacie(idPha) ON DELETE CASCADE
)engine=InnoDB;


create table choisir_pharmacie
(
idPa int(9) not null,
idPha int(9) not null,
primary key(idPa,idPha),
foreign key(idPa) references patient(idPa) ON DELETE CASCADE,
foreign key(idPha) references pharmacie(idPha) ON DELETE CASCADE
)engine=InnoDB;



create table produit
(
idPo int(9) not null auto_increment,
libelle varchar(50),
photo varchar(250),
description varchar(400),
idPha int(9),
primary key(idPo),
foreign key(idPha) references pharmacie(idPha) ON DELETE CASCADE
)engine=InnoDB;



create table commande
(
idCo int(9) not null auto_increment,
datelivraison date,
horairelivraison varchar(100),
modulepaiement varchar(200),
primary key(idCo)
)engine=InnoDB;



create table comporter_medicament
(
idMe int(9) not null,
idCo int(9) not null,
primary key(idMe,idCo),
foreign key(idMe) references medicament(idMe) ON DELETE CASCADE,
foreign key(idCo) references commande(idCo) ON DELETE CASCADE
)engine=InnoDB;



create table posseder_traitement
(
idT int(9) not null,
etatTraitement ENUM("en cours","terminer"),
idPa int(9) not null,
primary key(idT,idPa),
foreign key(idT) references traitement(idT) ON DELETE CASCADE,
foreign key(idPa) references patient(idPa) ON DELETE CASCADE
)engine=InnoDB;



create table avoir_produit
(
idPo int(9) not null,
idMe int(9) not null,
primary key(idPo,idMe),
foreign key(idPo) references produit(idPo) ON DELETE CASCADE,
foreign key(idMe) references medicament(idMe) ON DELETE CASCADE
)engine=InnoDB;


create table avoir_allergie
(
idAl int(9) not null,
idPa int(9) not null,
primary key(idAl,idPa),
foreign key(idAl) references allergie(idAl) ON DELETE CASCADE,
foreign key(idPa) references patient(idPa) ON DELETE CASCADE
)engine=InnoDB;


create table suivre_commande
(
idPh int(9) not null,
idCo int(9) not null,
primary key(idPh,idCo),
foreign key(idPh) references pharmacien(idPh) ON DELETE CASCADE,
foreign key(idCo) references commande(idCo) ON DELETE CASCADE
)engine=InnoDB;



create table livrer_commande
(
idL int(9) not null,
idCo int(9) not null,
primary key(idL,idCo),
foreign key(idL) references livreur(idL) ON DELETE CASCADE,
foreign key(idCo) references commande(idCo) ON DELETE CASCADE
)engine=InnoDB;



insert into utilisateur values 
(null,'Dupont','Julien','homme','32 rue Convention','Paris',75015,'j.dupont@gmail.com','abcd1234'),
(null,'Richard','Jean','homme','3 rue Vaugirard','Paris', 75015,'j.richard@gmail.com','abcd1234'),
(null,'Marchand','Carole','femme','12 rue Cauchy',75015,'Paris','c.marchand@hotmail.com','abcd1234'),
(null,'Martel','Georges','homme','2 rue Borromée',75015,'Paris','g.martel@gmail.com','abcd1234'),
(null,'Victan','brex','homme','139 boulevard norton','Vidolie',95052,'victan@gmail.com','abcd1234');

insert into assurancemaladie values 
(null,'ameli');

insert into patient values 
(1,35,false,false,1);
insert into medecin values 
(2);


insert into livreur values 
(4);


insert into allergie values 
(null,'acariens');
insert into allergie values 
(null,'pollen');




insert into traitement values 
(null,'antihistaminique'),
(null,'Semcta'),
(null,'Doliprane 3');


insert into posseder_traitement values 
(1,"en cours",1),
(2,"terminer",1);








insert into ordonnance values 
(null,'30/04/2021','antihistaminique 2 boites',1,2);


insert into medicament values 
(null,'doliprane','doliprane.jpg','antalgique et antipyrétique'),
(null,'Semcta','Semcta.jpg','maux de ventre');



insert into notice values 
(null,'noticedoliprane.pdf',1);


insert into pharmacie values 
(null,'Pharmacie Lourmel','105 avenue Félix Faure',75015,'Paris',10,19),
(null,'Pharmacie Beaumont','105 avenue Félix Faure',95420,'Beaumont',10,19),
(null,'Pharmacie Persant','105 avenue Félix Faure',95420,'Persant',10,19);


insert into pharmacien values 
(4,1);

insert into correspondre_medicament values 
(1,1);


insert into produit values 
(null,'masque FFP2','masque.jpg','modèle de masque de protection autofiltrant de type jetable',1);


insert into commande values 
(null,'05/05/2021','10h - 14h','PayPal');


insert into comporter_medicament values 
(1,1);

insert into avoir_produit values 
(1,1);


insert into suivre_commande values 
(1,1);


insert into livrer_commande values 
(4,1);




insert into avoir_allergie values 
(1,1);








