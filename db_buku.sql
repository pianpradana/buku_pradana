-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2021 at 10:06 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_buku`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `idAdmin` int(11) NOT NULL,
  `namaAdmin` varchar(30) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `status` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`idAdmin`, `namaAdmin`, `username`, `password`, `status`) VALUES
(1, 'Administrator', 'admin', 'admin', 'aktif'),
(2, 'Pradana', 'pradana', 'pian123', 'aktif'),
(3, 'Coba', 'coba', 'cobadong', 'hapus');

-- --------------------------------------------------------

--
-- Table structure for table `bahasa`
--

CREATE TABLE `bahasa` (
  `idBahasa` int(11) NOT NULL,
  `namaBahasa` varchar(25) NOT NULL,
  `status` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bahasa`
--

INSERT INTO `bahasa` (`idBahasa`, `namaBahasa`, `status`) VALUES
(1, 'Indonesia', 'aktif'),
(2, 'Inggris', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `idBuku` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `judul` varchar(30) NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `sinopsis` text NOT NULL,
  `halaman` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `link` varchar(50) NOT NULL,
  `idPengarang` int(11) NOT NULL,
  `idPenerbit` int(11) NOT NULL,
  `idKategori` int(11) NOT NULL,
  `idBahasa` int(11) NOT NULL,
  `idGenre` int(11) NOT NULL,
  `status` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`idBuku`, `tanggal`, `judul`, `gambar`, `sinopsis`, `halaman`, `tahun`, `link`, `idPengarang`, `idPenerbit`, `idKategori`, `idBahasa`, `idGenre`, `status`) VALUES
(1, '2021-01-01 10:24:22', 'Harry Potter', 'harry.jpg', 'Harry memulai tahun ketiganya di Hogwarts dengan tidak cukup menyenangkan. Secara ceroboh dia menyihir bibi Merge, kemudian melarikan diri. Di tengah perjalanannya, dia membaca berita tentang kaburnya seorang tawanan berbahaya, Sirius Black, yang dirumorkan ingin membunuhnya. Mr. Weasley kemudian memintanya untuk mengucapkan janji yang aneh, bahwa tak peduli apapun yang dia dengar, dia tidak akan pergi untuk mencari Black. Kebingungan, Harry mengiyakan saja.\r\n\r\nDalam perjalanan kembali ke sekolah, Harry melihat Dementor, makhluk penghisap jiwa, berkeliaran di sekitar Hogwarts sebagai perlindungan terhadap Black. Pengaruh Dementor terhadap Harry jauh lebih besar dibandingkan terhadap siswa-siswa Hogwarts, karena masa kecilnya yang suram. Setiap kali mereka mendekat, Harry akan kolaps. Profesor Lupin, guru Pertahanan terhadap Sihir Hitam yang baru, kemudian mengajarinya mantra Patronus, satu-satunya mantra yang dapat digunakan untuk melawan Dementor.\r\n\r\nSekolah tahun ketiga dimulai, dan merekapun tenggelam dalam tugas. Di tengah-tengah itu, Ron dan Hermione terlibat dalam percekcokan kecil akibat perilaku hewan peliharaan mereka. Hermione mengambil kelas yang sangat banyak, bahkan teman-temannya bingung bagaimana dia bisa mengikuti semua kelas yang diambilnya. Di tengah kepadatan aktivitasnya itu kucing Hermione, Crookshanks, berulang-ulang berusaha memakan tikus Ron, Scabbers; sehingga dua sahabat itu tak henti-hentinya beradu argumen tentang hewan peliharaan mereka. Perdebatan mereka terhenti setelah mereka menemukan ekor Scabbers terlihat di antara mulut Crookshanks, yang membuat hati Ron hancur.\r\n\r\nHarry mendapat panggilan dari Black ketika dia diam-diam masuk kastil. Pada akhir tahun beberapa kejadian berlangsung beruntun dialami Harry dan teman-temannya. Tikus Ron, Scabbers, ternyata masih hidup, dan ternyata merupakan jelmaan dari penyihir, Peter Pettigrew, orang yang disangka sudah mati.\r\n\r\nHarry kemudian juga mengetahui bahwa yang menghianati orang tuanya bukanlah Sirius Black, melainkan Peter. Sayangnya Peter berhasil melarikan diri di kegelapan malam, sehingga lolos dari hukuman akibat kejahatannya.', 500, 2010, 'link', 1, 1, 1, 1, 4, 'hapus'),
(2, '2021-01-01 19:14:12', 'Gajah Mada Seri 3', 'gama.jpg', 'Dikisahkan bahwa pada masa pemerintahan Jayanegara, kerajaan Majapahit banyak mengalami pemberontakan, salah satunya makar yang dilakukan oleh Ra Kuti. Pemberontakan yang dilakukan oleh Ra Kuti berhasil menguasai istana sehingga memaksa Prabu Sri Jayanegara bersama keluarganya mengungsi. Dalam pengungsiannya Jayanegara dikawal oleh pasukan Bhayangkara yang dipimpin oleh Gajah Mada. Masa penyelamatan Jayanegara ini merupakan bagian paling menegangkan dari isi cerita. Adanya telik sandi (mata-mata) dari pihak Ra Kuti ke dalam pasukan Bhayangkara sempat membuat pasukan Bhayangkara dan Gajah Mada sendiri kewalahan. Sehingga diputuskan Gajah Mada sendiri yang mengawal raja.\r\n\r\nPada akhirnya kemenangan berada di pihak Jayanegara. Pasukan Bhayangkara berhasil merebut istana serta mengembalikan Sri Prabu Jayanegara menjadi raja Majapahit. Namun kemudian Jayanegara sakit. Untuk menyembuhkan sakitnya maka didatangkan seorang tabib yang bernama Ra Tanca. Ra Tanca ini sesungguhnya adalah orang yang masih menyimpan dendam dan sakit hati pada Jayanegara. Dengan kepandaiannya meracik obat dia mengakali Gajah Mada. Ra Tanca membuat racun yang seolah-olah obat untuk diminumkan kepada Jayanegara. Saat itu juga raja meninggal. Mengetahui rajanya terbunuh, Gajah Mada segera menghukum mati Ra Tanca.\r\n\r\nBagaimana kelanjutannya? Silakan baca buku kedua dari 5 seri buku Gajah Mada ini.\r\n\r\nKisah Gajah Mada dibuat 5 seri, yaitu: Gajah Mada, Bergelut dalam kemelut takhta dan angkara, Hamukti Palapa, Perang Bubat, dan Madakaripura Hamukti Moksa.\r\n\r\nNama Gajah Mada tidak lepas dari Majapahit. Dari seorang bekel, ia kemudian menjadi orang besar yang menghantar Majapahit mencapai puncak kejayaannya. Langit Kresna Hariadi, penulis buku ini mampu menuliskan cerita dengan sangat menarik. Pembaca seakan dibawa hanyut ke dalam sebuah petualangan yang seru dan mendebarkan.\r\n\r\nSebagai buku fiksi bernuansa sejarah, buku ini sedikitnya mampu membuat saya kembali tertarik menapak tilasi sejarah dari sebuah kejayaan besar yang ada di bumi nusantara.', 600, 2001, '', 2, 2, 1, 1, 3, 'aktif'),
(3, '2021-01-02 04:22:57', 'Nagasasra Sabuk Inten', 'nagasasra.jpg', 'Mahesa Jenar pergi mengembara meninggalkan Istana Demak karena perselisihan soal keyakinan agama (Mahesa Jenar adalah murid Syekh Siti Jenar, seperti juga Ki Kebo Kenanga alias Ki Ageng Pengging) dan karena hilangnya pusaka-pusaka Kesultanan Demak, di antaranya keris-keris Kiai Nagasasra dan Kiai Sabukinten. Keris-keris itu ternyata tengah menjadi rebutan tokoh-tokoh golongan hitam, karena dianggap bisa menjadi sipat kandel (Jawa: modal spiritual) bagi penguasa Tanah Jawa.\r\n\r\nSementara itu dalam perjalanannya menemukan kembali keris Nagasasra dan Sabukinten, Mahesa Jenar menemukan beberapa persoalan lain yang saling kait mengait. Menghilangnya ayah Rara Wilis, yang kemudian menjadi kepala gerombolan di Gunung Tidar. Sementara itu sahabatnya, Ki Ageng Gajah Sora yang menjadi Kepala Daerah Perdikan Banyu Biru, difitnah oleh adiknya, Ki Ageng Lembu Sora, yang tamak ingin menguasai wilayah Banyu Biru, dan pada akhirnya harus ditangkap dan ditahan di Demak. Dalam pada itu, semua gerombolan dari golongan hitam itu berdatangan menyerbu ke Banyu Biru, karena adanya isu keberadaan keris Nagasasra dan Sabukinten di daerah tersebut. Mahesa Jenar, dengan dibantu sahabat-sahabatnya, berupaya keras menyelamatkan Banyu Biru dari bencana, sambil mendidik Arya Salaka sebagai pewaris wilayah Banyu Biru pada masa depan. Sedangkan keris-keris Nagasasra dan Sabukinten diselamatkan oleh seorang sakti yang selalu diliputi oleh rahasia, namun sangat dihormati oleh Baginda Sultan Trenggana dari Demak. ', 99, 2017, '', 2, 1, 1, 2, 3, 'aktif'),
(4, '2021-01-01 10:13:52', 'Pengobatan Infeksi Coronavirus', 'covid1.png', ' Tak ada perawatan khusus untuk mengatasi infeksi virus corona. Umumnya pengidap akan pulih dengan sendirinya. Namun, ada beberapa upaya yang bisa dilakukan untuk meredakan gejala infeksi virus corona. Contohnya:\r\n\r\n    Minum obat yang dijual bebas untuk mengurangi rasa sakit, demam, dan batuk. Namun, jangan berikan aspirin pada anak-anak. Selain itu, jangan berikan obat batuk pada anak di bawah empat tahun.\r\n    Gunakan pelembap ruangan atau mandi air panas untuk membantu meredakan sakit tenggorokan dan batuk.\r\n    Perbanyak istirahat.\r\n    Hindari menyentuh hewan atau unggas liar.\r\n    Perbanyak asupan cairan tubuh.\r\n    Jika merasa khawatir dengan gejala yang dialami, segeralah hubungi penyedia layanan kesehatan terdekat.\r\n\r\nKhusus untuk virus corona yang menyebabkan penyakit serius, seperti SARS, MERS, atau infeksi COVID-19, penanganannya akan disesuaikan dengan penyakit yang diidap dan kondisi pasien.\r\n\r\nBila pasien mengidap infeksi novel coronavirus, dokter akan merujuk ke RS Rujukan yang telah ditunjuk oleh Dinkes (Dinas Kesehatan) setempat. Bila tidak bisa dirujuk karena beberapa alasan, dokter akan melakukan:\r\n\r\n    Isolasi\r\n    Serial foto toraks sesuai indikasi.\r\n    Terapi simptomatik.\r\n    Terapi cairan.\r\n    Ventilator mekanik (bila gagal napas)\r\n    Bila ada disertai infeksi bakteri, dapat diberikan antibiotik.\r\n', 100, 2020, 'aaa', 1, 2, 2, 1, 4, 'aktif'),
(5, '2021-01-01 10:13:57', 'Pencegahan Infeksi Coronavirus', 'covid2.png', ' Sampai saat ini belum ada vaksin untuk mencegah infeksi virus corona. Namun, setidaknya ada beberapa cara yang bisa dilakukan untuk mengurangi risiko terjangkit virus ini. Berikut upaya yang bisa dilakukan:\r\n\r\n    Sering-seringlah mencuci tangan dengan sabun dan air selama 20 detik hingga bersih.\r\n    Hindari menyentuh wajah, hidung, atau mulut saat tangan dalam keadaan kotor atau belum dicuci.\r\n    Hindari kontak langsung atau berdekatan dengan orang yang sakit.\r\n    Hindari menyentuh hewan atau unggas liar.\r\n    Tutup hidung dan mulut ketika bersin atau batuk dengan tisu. Kemudian, buanglah tisu dan cuci tangan hingga bersih.\r\n    Jangan keluar rumah dalam keadaan sakit.\r\n    Kenakan masker dan segera berobat ke fasilitas kesehatan ketika mengalami gejala penyakit saluran napas.\r\n\r\nSelain itu, kamu juga bisa perkuat sistem kekebalan tubuh dengan konsumsi vitamin dan suplemen sebagai bentuk pencegahan dari virus ini. ', 123, 2020, 'sss', 2, 1, 2, 2, 3, 'aktif'),
(11, '2021-01-01 10:25:42', 'Laskar Pelangi2', 'Laskar_pelangi_sampul.jpg', 'Laskar Pelangi adalah novel pertama karya Andrea Hirata yang diterbitkan oleh Bentang Pustaka pada tahun 2005. Novel ini bercerita tentang kehidupan 10 anak dari keluarga miskin yang bersekolah (SD dan SMP) di sebuah sekolah Muhammadiyah di Belitung yang penuh dengan keterbatasan. Mereka adalah:\r\n\r\n    Ikal aka Andrea Hirata\r\n    Lintang; Lintang Samudra Basara bin Syahbani Maulana Basara\r\n    Sahara; N.A. Sahara Aulia Fadillah binti K.A. Muslim Ramdhani Fadillah\r\n    Mahar; Mahar Ahlan bin Jumadi Ahlan bin Zubair bin Awam\r\n    A Kiong (Chau Chin Kiong); Muhammad Jundullah Gufron Nur Zaman\r\n    Syahdan; Syahdan Noor Aziz bin Syahari Noor Aziz\r\n    Kucai; Mukharam Kucai Khairani\r\n    Borek aka Samson\r\n    Trapani; Trapani Ihsan Jamari bin Zainuddin Ilham Jamari\r\n    Harun; Harun Ardhli Ramadan bin Syamsul Hazana Ramadan\r\n\r\nMereka bersekolah dan belajar pada kelas yang sama dari kelas 1 SD sampai kelas 3 SMP, dan menyebut diri mereka sebagai Laskar Pelangi. Pada bagian-bagian akhir cerita, anggota Laskar Pelangi bertambah satu anak perempuan yang bernama Flo, seorang murid pindahan. Keterbatasan yang ada bukan membuat mereka putus asa, tetapi malah membuat mereka terpacu untuk dapat melakukan sesuatu yang lebih baik.\r\n\r\nLaskar Pelangi merupakan buku pertama dari Tetralogi Laskar Pelangi. Buku berikutnya adalah Sang Pemimpi, Edensor dan Maryamah Karpov. Buku ini tercatat sebagai buku sastra Indonesia terlaris sepanjang sejarah.\r\n\r\nCerita terjadi di desa Gantung, Belitung Timur. Dimulai ketika sekolah Muhammadiyah terancam akan dibubarkan oleh Depdikbud Sumsel jikalau tidak mencapai siswa baru sejumlah 10 anak. Ketika itu baru 9 anak yang menghadiri upacara pembukaan, akan tetapi tepat ketika Pak Harfan, sang kepala sekolah, hendak berpidato menutup sekolah, Harun dan ibunya datang untuk mendaftarkan diri di sekolah kecil itu.\r\n\r\nDari sanalah dimulai cerita mereka. Mulai dari penempatan tempat duduk, pertemuan mereka dengan Pak Harfan, perkenalan mereka yang luar biasa di mana A Kiong yang malah cengar-cengir ketika ditanyakan namanya oleh guru mereka, Bu Mus. Kejadian bodoh yang dilakukan oleh Borek, pemilihan ketua kelas yang diprotes keras oleh Kucai, kejadian ditemukannya bakat luar biasa Mahar, pengalaman cinta pertama Ikal, sampai pertaruhan nyawa Lintang yang mengayuh sepeda 80 km pulang pergi dari rumahnya ke sekolah.\r\n\r\nMereka, Laskar Pelangi - nama yang diberikan Bu Muslimah akan kesenangan mereka terhadap pelangi - pun sempat mengharumkan nama sekolah dengan berbagai cara. Misalnya pembalasan dendam Mahar yang selalu dipojokkan kawan-kawannya karena kesenangannya pada okultisme yang membuahkan kemenangan manis pada karnaval 17 Agustus, dan kegeniusan luar biasa Lintang yang menantang dan mengalahkan Drs. Zulfikar, guru sekolah kaya PN yang berijazah dan terkenal, dan memenangkan lomba cerdas cermat. Laskar Pelangi mengarungi hari-hari menyenangkan, tertawa dan menangis bersama. Kisah sepuluh kawanan ini berakhir dengan kematian ayah Lintang yang memaksa Einstein cilik itu putus sekolah dengan sangat mengharukan, dan dilanjutkan dengan kejadian 12 tahun kemudian di mana Ikal yang berjuang di luar pulau Belitong kembali ke kampungnya. Kisah indah ini diringkas dengan kocak dan mengharukan oleh Andrea Hirata, kita bahkan bisa merasakan semangat masa kecil anggota sepuluh Laskar Pelangi ini. ', 0, 2005, '', 3, 2, 1, 1, 3, 'hapus'),
(12, '2021-01-01 10:23:38', 'Python in a Nutshell, 3rd Edit', '250w.jpg', 'Useful in many roles, from design and prototyping to testing, deployment, and maintenance, Python is consistently ranked among todayâ€™s most popular programming languages. The third edition of this practical book provides a quick reference to the languageâ€”including Python 3.5, 2.7, and highlights of 3.6â€”commonly used areas of its vast standard library, and some of the most useful third-party modules and packages.\r\n\r\nIdeal for programmers with some Python experience, and those coming to Python from other programming languages, this book covers a wide range of application areas, including web and network programming, XML handling, database interactions, and high-speed numeric computing. Discover how Python provides a unique mix of elegance, simplicity, practicality, and sheer power.\r\n\r\nThis edition covers:', 0, 2005, '', 2, 2, 2, 2, 2, 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `idGenre` int(11) NOT NULL,
  `namaGenre` varchar(25) NOT NULL,
  `status` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`idGenre`, `namaGenre`, `status`) VALUES
(1, 'Humor', 'aktif'),
(2, 'Horor', 'aktif'),
(3, 'Petualangan', 'aktif'),
(4, 'Misteri', 'aktif'),
(5, 'Science Fiction', 'aktif'),
(6, 'Romance', 'aktif'),
(7, 'Fantasi', 'aktif'),
(8, 'Coba', 'hapus');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `idKategori` int(11) NOT NULL,
  `namaKategori` varchar(20) NOT NULL,
  `status` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`idKategori`, `namaKategori`, `status`) VALUES
(1, 'Fiksi', 'aktif'),
(2, 'Non Fiksi', 'aktif'),
(3, 'Anak-Anak', 'aktif'),
(4, 'Religi', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `idMenu` int(11) NOT NULL,
  `namaMenu` varchar(15) NOT NULL,
  `url` varchar(50) NOT NULL,
  `status` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`idMenu`, `namaMenu`, `url`, `status`) VALUES
(1, 'Beranda', 'index.php', 'aktif'),
(2, 'Perpustakaan', 'index.php', 'aktif'),
(3, 'Tentang', 'tentang.php', 'aktif'),
(4, 'Kontak', 'kontak.php', 'aktif'),
(5, 'Coba2', 'coba.php', 'hapus');

-- --------------------------------------------------------

--
-- Table structure for table `penerbit`
--

CREATE TABLE `penerbit` (
  `idPenerbit` int(11) NOT NULL,
  `namaPenerbit` varchar(30) NOT NULL,
  `status` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penerbit`
--

INSERT INTO `penerbit` (`idPenerbit`, `namaPenerbit`, `status`) VALUES
(1, 'Gema Insani Pers', 'aktif'),
(2, 'Grasindo', 'aktif'),
(3, 'Kompas', 'hapus');

-- --------------------------------------------------------

--
-- Table structure for table `pengarang`
--

CREATE TABLE `pengarang` (
  `idPengarang` int(11) NOT NULL,
  `namaPengarang` varchar(30) NOT NULL,
  `status` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengarang`
--

INSERT INTO `pengarang` (`idPengarang`, `namaPengarang`, `status`) VALUES
(1, 'J.K Rowling', 'aktif'),
(2, 'Asma Nadia', 'aktif'),
(3, 'Andrea Hirata', 'aktif'),
(4, 'Coba', 'hapus');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `namaWeb` varchar(25) NOT NULL,
  `slogan` varchar(50) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `copyright` varchar(50) NOT NULL,
  `facebook` varchar(50) NOT NULL,
  `youtube` varchar(50) NOT NULL,
  `instagram` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `whatsapp` varchar(50) NOT NULL,
  `telepon` varchar(50) NOT NULL,
  `tentang` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `namaWeb`, `slogan`, `alamat`, `logo`, `copyright`, `facebook`, `youtube`, `instagram`, `email`, `whatsapp`, `telepon`, `tentang`) VALUES
(1, 'Pradana\'s Books', ' You\'re Only One Book Away From a Good Mood.', 'Pondok Aren, Jurang Manggu', 'toppng.com-experience-the-discussion-online-library-book-logo-401x253.png', '2021', 'https://www.facebook.com/pradana110301/', 'https://www.youtube.com/channel/UC6Ywu2VptFPDJf2Xx', 'https://www.instagram.com/pian.pradana/', 'pradana@email.com', '1111111', '2222222', 'Buku adalah kumpulan/himpunan kertas atau bahan lainnya yang dijilid menjadi satu pada salah satu ujungnya dan berisi tulisan, gambar, atau tempelan. Setiap sisi dari sebuah lembaran kertas pada buku disebut sebuah halaman.  Seiring dengan perkembangan dalam bidang dunia informatika, kini dikenal pula istilah e-book atau buku-e (buku elektronik), yang mengandalkan perangkat seperti komputer meja, komputer jinjing, komputer tablet, telepon seluler dan lainnya, serta menggunakan perangkat lunak tertentu untuk membacanya.  Dalam bahasa Indonesia terdapat kata kitab yang diserap dari bahasa Arab (كتاب), yang memiliki arti buku. Kemudian pada penggunaan kata tersebut, kata kitab ditujukan hanya kepada sebuah teks atau tulisan yang dijilid menjadi satu. Biasanya kitab merujuk kepada jenis tulisan kuno yang mempunyai ketetapan hukum, atau dengan kata lain merupakan undang-undang yang mengatur. Istilah kitab biasanya digunakan untuk menyebut karya sastra para pujangga pada masa lampau yang dapat dijadikan sebagai bukti sejarah untuk mengungkapkan suatu peristiwa masa lampau seperti halnya kitab suci. Kerajaan-kerajaan di Nusantara pada masa lampau memberi kedudukan yang penting bagi para pujangga untuk menceritakan kehidupan dan kekuasaan raja-raja pada waktu itu untuk diriwayatkan dengan cara ditulis.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idAdmin`);

--
-- Indexes for table `bahasa`
--
ALTER TABLE `bahasa`
  ADD PRIMARY KEY (`idBahasa`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`idBuku`),
  ADD KEY `idBahasa` (`idBahasa`),
  ADD KEY `idKategori` (`idKategori`),
  ADD KEY `idPenerbit` (`idPenerbit`),
  ADD KEY `idPengarang` (`idPengarang`),
  ADD KEY `idGenre` (`idGenre`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`idGenre`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idKategori`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`idMenu`);

--
-- Indexes for table `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`idPenerbit`);

--
-- Indexes for table `pengarang`
--
ALTER TABLE `pengarang`
  ADD PRIMARY KEY (`idPengarang`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `idAdmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bahasa`
--
ALTER TABLE `bahasa`
  MODIFY `idBahasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `idBuku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `idGenre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `idKategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `idMenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `idPenerbit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pengarang`
--
ALTER TABLE `pengarang`
  MODIFY `idPengarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`idBahasa`) REFERENCES `bahasa` (`idBahasa`),
  ADD CONSTRAINT `buku_ibfk_2` FOREIGN KEY (`idKategori`) REFERENCES `kategori` (`idKategori`),
  ADD CONSTRAINT `buku_ibfk_3` FOREIGN KEY (`idPenerbit`) REFERENCES `penerbit` (`idPenerbit`),
  ADD CONSTRAINT `buku_ibfk_4` FOREIGN KEY (`idPengarang`) REFERENCES `pengarang` (`idPengarang`),
  ADD CONSTRAINT `buku_ibfk_5` FOREIGN KEY (`idGenre`) REFERENCES `genre` (`idGenre`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
