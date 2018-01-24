-- phpMyAdmin SQL Dump
-- version 3.4.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 10. Desember 2014 jam 08:26
-- Versi Server: 5.5.15
-- Versi PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_jualan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
  `idbarang` varchar(4) NOT NULL,
  `namabarang` varchar(50) DEFAULT NULL,
  `harga` double(10,0) DEFAULT NULL,
  `stok` int(3) DEFAULT NULL,
  PRIMARY KEY (`idbarang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`idbarang`, `namabarang`, `harga`, `stok`) VALUES
('B004', 'Mie Instan Goreng2', 2000, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `idcust` varchar(4) NOT NULL,
  `namacust` varchar(50) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `telp` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idcust`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`idcust`, `namacust`, `alamat`, `telp`) VALUES
('C001', 'Udin2', 'jl petukangan no 2', '081276789872');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detiljual`
--

CREATE TABLE IF NOT EXISTS `detiljual` (
  `idjual` int(3) NOT NULL,
  `idbarang` varchar(4) NOT NULL,
  `qty` int(3) DEFAULT NULL,
  `hargajual` double(10,0) DEFAULT NULL,
  PRIMARY KEY (`idjual`,`idbarang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `user` varchar(50) NOT NULL,
  `pass` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`user`, `pass`) VALUES
('admin', '0192023a7bbd73250516f069df18b500'),
('juki', 'cee8d6b7ce52554fd70354e37bbf44a2'),
('wahyu', 'wahyu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transjual`
--

CREATE TABLE IF NOT EXISTS `transjual` (
  `idjual` int(3) NOT NULL,
  `idcust` varchar(4) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `total` double(10,0) DEFAULT NULL,
  PRIMARY KEY (`idjual`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
