create database movie_web character set 'utf8';
use movie_web;
drop database movie_web;

create table genres(
	g_id int not null,
    g_name varchar(50),
    primary key(g_id)
);
insert into genres (g_id, g_name) values
(1, 'Action'),
(2, 'Romance'),
(3, 'Adventure'),
(4, 'Comedy');
select * from genres;

create table movies(
	movie_id int not null primary key,
    title varchar(100) not null,
	g_id int,
    constraint fk_genreId foreign key(g_id) references genres(g_id),
    age_category varchar(3) default null,
    summary varchar(800) default null,
    season int not null,
    episodes int not null,
    run_time varchar(20) not null,
    img_path varchar(100) not null,
    trailer varchar(100) default null,
    rating int default null,
    status int not null default 0
);
insert into movies (movie_id,title,g_id,age_category,summary, season,episodes,run_time,img_path,trailer,rating,status) values
(1,'Demons Slayer: Kimetsu no Yaiba',1,'16+',
'Originally a manga created by Koyoharu Gotoge, Demon Slayer: Kimetsu no Yaiba follows kindhearted charcoal seller Tanjiro, whose life changes forever when his family is attacked by demons. In order to return his sister, who is now a demon, to her former state and avenge his family, Tanjiro sets out on a dangerous journey.'
,2021, 1, '1hrs 45mins', 'demonslayer.jpg',null,10,1),
(2,'Jujutsu Kaisen',1,'16+',
"Yuji Itadori, a kind-hearted teenager, joins his school's Occult Club for fun, but
                                discovers that its members are actual sorcerers who can manipulate the energy between
                                beings for their own use. He hears about a cursed talisman - the finger of Sukuna, a
                                demon - and its being targeted by other cursed beings."
,2023,1,'1hrs 50mins','jujutsu1.jpg',null,10,default),
(3,'Coco',3,'8+',
"Aspiring musician Miguel, confronted with his family's ancestral ban on music, enters the Land of the Dead to find his great-great-grandfather, a legendary singer."
, 2020,1,'1hrs 50mins','coco.jpg',null,10,1),
(4,'Conan: Movie 22',1,'10+',
"The shadow of Tooru Amuro, who works for the National Police Agency Security Bureau as Zero, appears at the site. In addition, the 'triple-face' character is known as Rei Furuya as a detective and Kogorou Mouri's apprentice, and he is also known as Bourbon as a Black Organization member. Kogorou is arrested as a suspect in the case of the explosion. 
Conan conducts an investigation to prove Kogorou's innocence, but Amuro gets in his way."
, 2022,1,'1hrs 50mins','conan1.jpg',null,9,1),
(5,'Doremon',4,'5+',
"Doraemon is a robotic cat that comes from the 22nd century. He comes to 20th century and stays with Nobi Family. The Nobis love Doraemon very much. So Doraemon always help the Nobis with the devices from 22nd century."
, 2024,88,'30mins','doremon1.jpg',null,8,1),
(6,'Genshin Impact 1',3,'13+',
"Traveler as they go on a quest to find their missing sibling with the companion Paimon. Armed with the power to tap into the elements without a vision, the Traveler breaks all the laws within Teyvat and performs near-impossible feats."
, 2019,1,'1hrs 50mins','genshin1.jpg',null,7,default),
(7,'Genshin Impact 2',3,'13+',
"To find their sibling, they must venture to all seven regions and learn the hidden truth surrounding the world. On the journey, Traveler and Paimon discover numerous secrets that define the laws of Teyvat, and the history of the Archon War is also slowly revealed to them."
, 2020,1,'1hrs 40mins','genshin2.jpg',null,8,default),
(8,'Grave of the Fireflies',3,'12+',
"An aunt's struggle to survive in Japan during World War II while caring for her niece and nephew.An aunt's struggle to survive in Japan during World War II ..."
, 2021,1,'2hrs 10mins','grave.jpg',null,7.5,1),
(9,'Inuyasha 1',1,'12+',
"A teenage girl periodically travels back in time to feudal Japan to help a young half-demon recover the shards of a jewel of great power."
, 2016,1,'1hrs 59mins','inu.jpg',null,10,default),
(10,'Princess Monosoke',1,'10+',
"Ashitaka is infected with an incurable disease by a possessed boar/god. He is to die
                                unless he can find a cure to rid the curse from his body. It seems that his only hope is
                                to travel to the far east. When he arrives to get help from the deer god, he finds
                                himself in the middle of a battle between the animal inhabitants of the forest and an
                                iron mining town that is exploiting and killing the forest. Leading the forest animals
                                in the battle is a human raised by wolves, Princess Mononoke."
, 2022,1,'1hrs 30mins','monosoke.jpg',null,10,default),
(11,'Kung Fu Panda 3',1,'7+',
"After reuniting with his long-lost father, Po must transition from student to teacher and train a group of fun-loving, clumsy pandas to become martial-arts fighters. Together, the kung-fu brethren unite to take on the evil Kai"
, 2023,1,'1hrs 50mins','panda1.jpg',null,7.5,default),
(12,'Pokemon',3,'7+',
"The great adventures of 10 year old Ash Ketchum, a young Pokémon Trainer from Pallet Town, as well as his best friend and everlasting companion Pikachu."
, 2018,32,'50mins','pokemon1.jpg',null,10,default),
(13,'Ponyo',4,'10+',
"The film tells the story of Ponyo, a goldfish who escapes from the ocean and is helped by a five-year-old human boy, Sōsuke, after she is washed ashore ..."
, 2020,1,'1hrs 50mins','ponyo.jpg',null,10,default),
(14,'Shin Crayon',4,'12+',
"The five-year-old is a cut above the most troublesome, perverted, and shameless kid one can imagine. Shin-chan is almost always engaged in questionable ..."
, 2022,1,'1hrs 10mins','shin1.jpg',null,10,default),
(15,'Spy X Family',4,'12+',
"A spy known only as Twilight needs a family as part of his undercover mission, so he quickly marries a city hall worker and adopts a child and dog."
, 2023,14,'48mins','spyfam1.jpg',null,10,default),
(16,"Suzume's Door Locking",2,'15+',
"The film follows 17-year-old high school girl Suzume Iwato and young stranger Souta Munakata, who team up to prevent a series of disasters across Japan by ..."
, 2022,1,'2hrs 15mins','suzume.jpg',null,10,default),
(17,'Violet Evergarden 1',2,'16+',
"The Great War has finally come to an end. Caught up in
                                the bloodshed was Violet Evergarden, a young girl raised to be a deadly weapon on the
                                battlefield. Hospitalized and maimed in a bloody skirmish during the War's final leg,
                                she was left with only words from the person she held dearest, but no understanding of
                                their meaning. Recovering from her wounds, Violet starts a new life working at CH Postal
                                Services. There, she witnesses by pure chance the work of an 'Auto Memory Doll'..."
, 2022,12,'55mins','violet1.jpg',null,10,default),
(18,'Violet Evergarden 2',2,'16+',
"The story follows Violet Evergarden's journey of reintegrating back into society after the war is over as she is no longer a soldier, and her search for her life's purpose in order to understand the last words her mentor and guardian, Major Gilbert, had said to her: 'I love you.'"
, 2023,12,'57mins','violet2.jpg',null,10,default),
(19,'Your Name',2,'16+',
"Two teenagers share a profound, magical connection upon discovering they are swapping
                                bodies. Things manage to become even more complicated when the boy and girl decide to
                                meet in person. Two teenagers share a profound, magical connection upon discovering they
                                are swapping bodies."
, 2021,1,'2hrs 20mins','yourname.jpg',null,10,default),
(20,'The Wind Raises',2,'14+',
"During a test flight, the Falcon breaks apart in mid-air, and Jiro becomes frustrated by Japan's backwards technology, which utilizes mostly wood and canvas ..."
, 2016,1,'2hrs 10mins','thewind.jpg',null,10,default),
(21,'One Punch Man',1,'10+',
"Follows the life of an average hero who manages to win all of his punches with one punch!
                                This ends up being the cause of a lot of frustration as he no longer feels the thrill
                                and adrenaline of fighting a tough battle. Maybe all of his rigorous training to become
                                strong wasn't worth it. After all, what's so good about having an overwhelming power?"
, 2014,1,'1hrs 50mins','onepunch.jpg',null,10,default),
(22,"Holw's Moving Castle",2,'12+',
"Sophie, a young milliner and eldest of three sisters, encounters a wizard named Howl on
                                her way to visit her sister Lettie. Upon returning home, she meets the Witch of the
                                Waste, who transforms her into a 90-year-old woman..."
, 2015,1,'2hrs 50mins','castle.jpg',null,10,default),
(23,'My Neighbor Tororo',4,'8+',
"Sophie, a young milliner and eldest of three sisters, encounters a wizard named Howl on
                                her way to visit her sister Lettie. Upon returning home, she meets the Witch of the
                                Waste, who transforms her into a 90-year-old woman..."
, 2013,1,'2hrs 35mins','tororo.jpg',null,10,default);
select * from movies;

create table admins(
	id int not null,
    aname varchar(255) not null,
	email varchar(100) unique not null,
    phone varchar(11) unique not null,
    psswd varchar(20) unique not null,
    gender varchar(6) not null,
    img varchar(255) default 'user.png' ,
    primary key(id)
);
select * from admins;

insert into admins values(1,'admin 1','a1@gmail.com','0123456789','a1','male',default);
insert into admins values(2,'admin 2','a2@gmail.com','0123456788','a2','female',default);
insert into admins values(3,'Rosie','a3@gmail.com','0123456787','a3','female',default);

create table users(
	uid int auto_increment primary key,
    uname varchar(255) not null,
    email varchar(100) unique not null,
    phone varchar(11) unique not null,
    psswd varchar(20) not null,
    gender varchar(6) not null,
    img varchar(255) default 'user.png'
);
insert into users values(1,'Thanh Tam','tt@gmail.com','0987654321','tt1','female','u5.png');
insert into users values(2,'Hoai Thuong','ht@gmail.com','0987654322','ht2','female',default);
select * from users;
  
create table mlist(
	listID int auto_increment,
	movie_id int,
    constraint movieId_fk
		foreign key(movie_id)
        references movies(movie_id),
	ip_address varchar(255),
    uid int,
    constraint uId_fk
		foreign key(uid)
        references users(uid),
	primary key(listID, movie_id)
); 
select * from mlist;

drop table reviews;
drop table mlist;
drop table users;
drop table admins;
drop table movies;
drop table genres;
drop database movie_web;