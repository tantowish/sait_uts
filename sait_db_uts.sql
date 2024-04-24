/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `mahasiswa`;
CREATE TABLE `mahasiswa` (
  `nim` varchar(10) NOT NULL,
  `nama` varchar(20) DEFAULT NULL,
  `alamat` varchar(40) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  PRIMARY KEY (`nim`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `matakuliah`;
CREATE TABLE `matakuliah` (
  `kode_mk` varchar(10) NOT NULL,
  `nama_mk` varchar(21) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `sks` int DEFAULT NULL,
  PRIMARY KEY (`kode_mk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `perkuliahan`;
CREATE TABLE `perkuliahan` (
  `id_perkuliahan` int NOT NULL AUTO_INCREMENT,
  `nim` varchar(10) DEFAULT NULL,
  `kode_mk` varchar(10) DEFAULT NULL,
  `nilai` double DEFAULT NULL,
  PRIMARY KEY (`id_perkuliahan`),
  KEY `nim` (`nim`),
  KEY `kode_mk` (`kode_mk`),
  CONSTRAINT `perkuliahan_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`),
  CONSTRAINT `perkuliahan_ibfk_2` FOREIGN KEY (`kode_mk`) REFERENCES `matakuliah` (`kode_mk`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `mahasiswa` (`nim`, `nama`, `alamat`, `tanggal_lahir`) VALUES
('sv_001', 'joko', 'bantul', '1999-12-07');
INSERT INTO `mahasiswa` (`nim`, `nama`, `alamat`, `tanggal_lahir`) VALUES
('sv_002', 'paul', 'sleman', '2000-10-07');
INSERT INTO `mahasiswa` (`nim`, `nama`, `alamat`, `tanggal_lahir`) VALUES
('sv_003', 'andy', 'surabaya', '2000-02-09');

INSERT INTO `matakuliah` (`kode_mk`, `nama_mk`, `sks`) VALUES
('svpl_001', 'database', 2);
INSERT INTO `matakuliah` (`kode_mk`, `nama_mk`, `sks`) VALUES
('svpl_002', 'kecerdasan artifisial', 2);
INSERT INTO `matakuliah` (`kode_mk`, `nama_mk`, `sks`) VALUES
('svpl_003', 'interoperabilitas', 2);

INSERT INTO `perkuliahan` (`id_perkuliahan`, `nim`, `kode_mk`, `nilai`) VALUES
(23, 'sv_001', 'svpl_001', 100);
INSERT INTO `perkuliahan` (`id_perkuliahan`, `nim`, `kode_mk`, `nilai`) VALUES
(24, 'sv_001', 'svpl_002', 100);
INSERT INTO `perkuliahan` (`id_perkuliahan`, `nim`, `kode_mk`, `nilai`) VALUES
(26, 'sv_002', 'svpl_002', 200);
INSERT INTO `perkuliahan` (`id_perkuliahan`, `nim`, `kode_mk`, `nilai`) VALUES
(27, 'sv_002', 'svpl_003', 100);


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;