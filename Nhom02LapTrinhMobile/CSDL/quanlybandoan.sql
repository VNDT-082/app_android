-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th5 23, 2023 lúc 05:35 AM
-- Phiên bản máy phục vụ: 8.0.31
-- Phiên bản PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanlybandoan`
--


-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chinhanh`
--

CREATE TABLE `chinhanh` (
  `MaChiNhanh` int NOT NULL,
  `TenChiNhanh` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `DiaChi` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `SDT` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdathang`
--

CREATE TABLE `chitietdathang` (
  `MaSanPham` int NOT NULL,
  `MaDonHang` int NOT NULL,
  `SoLuong` int DEFAULT '1',
  `GiaBan` float DEFAULT NULL,
  `KhuyenMai` int DEFAULT NULL,
  `GiamCon` float DEFAULT NULL,
  `MaSize` varchar(5) COLLATE utf8mb4_general_ci DEFAULT 'SM',
  `LuongDuong` varchar(30) COLLATE utf8mb4_general_ci DEFAULT 'vừa đủ',
  `LuongDa` varchar(30) COLLATE utf8mb4_general_ci DEFAULT 'vừa đủ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiettoppingdathang`
--

CREATE TABLE `chitiettoppingdathang` (
  `MaSanPham` int NOT NULL,
  `MaDonHang` int NOT NULL,
  `MaTopping` int NOT NULL,
  `Gia` float DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiettoppinggiohang`
--

CREATE TABLE `chitiettoppinggiohang` (
  `ID` int NOT NULL,
  `MaTopping` int NOT NULL,
  `Gia` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dathang`
--

CREATE TABLE `dathang` (
  `MaDonHang` int NOT NULL,
  `MaNguoiDung` int NOT NULL,
  `MaChiNhanh` varchar(512) COLLATE utf8mb4_general_ci NOT NULL,
  `TongTien` float DEFAULT '0',
  `UuDai` int DEFAULT NULL,
  `GiaGiamCon` float DEFAULT NULL,
  `TrangThai` bit(1) DEFAULT b'0',
  `NgayMua` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giohang`
--

CREATE TABLE `giohang` (
  `ID` int NOT NULL,
  `MaNguoiDung` int DEFAULT NULL,
  `MaSanPham` int DEFAULT NULL,
  `MaSize` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'SM',
  `SoLuong` int DEFAULT '0',
  `LuongDuong` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Vừa đủ',
  `LuongDa` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Vừa đủ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuyenmai`
--

CREATE TABLE `khuyenmai` (
  `IdKhuyenMai` int NOT NULL,
  `MaSanPham` int DEFAULT NULL,
  `NoiDung` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ChiTiet` int DEFAULT NULL,
  `NgayBatDau` date DEFAULT NULL,
  `NgayKetThuc` date DEFAULT NULL,
  `HinhAnh` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaikhachhang`
--

CREATE TABLE `loaikhachhang` (
  `MaLoaiKH` int NOT NULL,
  `TenLoaiKhach` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `UuDai` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaisanpham`
--

CREATE TABLE `loaisanpham` (
  `MaLoai` int NOT NULL,
  `TenLoai` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `hinhanh` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nguoidung`
--

CREATE TABLE `nguoidung` (
  `MaNguoiDung` int NOT NULL,
  `MaLoaiKH` int DEFAULT '1',
  `TenNguoiDung` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `SDTDangNhap` decimal(10,0) NOT NULL,
  `SDTLienHe` decimal(10,0) NOT NULL,
  `Email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `AnhDaiDien` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'PersonDefault.jpg',
  `GioiTinh` bit(1) DEFAULT NULL,
  `NgaySinh` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `MaNhanVien` int NOT NULL,
  `MaChiNhanh` int DEFAULT NULL,
  `TenNhanVien` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `SDTDangNhap` decimal(10,0) NOT NULL,
  `SDTLienHe` decimal(10,0) NOT NULL,
  `AnhDaiDien` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'PersonDefault.jpg',
  `GioiTinh` bit(1) DEFAULT NULL,
  `NgaySinh` date DEFAULT NULL,
  `NgayVaoLam` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanxet`
--

CREATE TABLE `nhanxet` (
  `id` int NOT NULL,
  `MaNguoiDung` int DEFAULT NULL,
  `MaSanPham` int DEFAULT NULL,
  `NoiDung` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `DanhGia` int DEFAULT NULL,
  `NgayDang` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `MaSanPham` int NOT NULL,
  `TenSanPham` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `MaLoai` int DEFAULT NULL,
  `MoTa` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `LuotMua` int DEFAULT '0',
  `HinhAnh` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'poster.jpg',
  `GiaBan` float DEFAULT NULL,
  `TrangThai` bit(1) DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `size`
--

CREATE TABLE `size` (
  `MaSize` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `TenSize` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Gia` float DEFAULT NULL,
  `HinhAnh` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'SizeM.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `SDTDangNhap` decimal(10,0) NOT NULL,
  `MatKhau` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `LoaiTaiKhoan` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongbaochinhanh`
--

CREATE TABLE `thongbaochinhanh` (
  `IdThongBao` int NOT NULL,
  `MaChiNhanh` int DEFAULT '1',
  `NoiDung` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `NgayGui` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thongbaonguoidung`
--

CREATE TABLE `thongbaonguoidung` (
  `IdThongBao` int NOT NULL,
  `MaNguoiDung` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `NoiDung` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `NgayGui` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `topping`
--

CREATE TABLE `topping` (
  `MaTopping` int NOT NULL,
  `TenTopping` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Gia` float DEFAULT '0',
  `HinhAnh` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'logo.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Chỉ mục cho bảng `chinhanh`
--
ALTER TABLE `chinhanh`
  ADD PRIMARY KEY (`MaChiNhanh`);

--
-- Chỉ mục cho bảng `chitietdathang`
--
ALTER TABLE `chitietdathang`
  ADD PRIMARY KEY (`MaSanPham`,`MaDonHang`),
  ADD KEY `FK_CTDH_DatHang` (`MaDonHang`);

--
-- Chỉ mục cho bảng `chitiettoppingdathang`
--
ALTER TABLE `chitiettoppingdathang`
  ADD PRIMARY KEY (`MaSanPham`,`MaDonHang`,`MaTopping`),
  ADD KEY `FK_ChiTietToppingDatHang_Topping` (`MaTopping`);

--
-- Chỉ mục cho bảng `chitiettoppinggiohang`
--
ALTER TABLE `chitiettoppinggiohang`
  ADD PRIMARY KEY (`ID`,`MaTopping`),
  ADD KEY `FK_ChiTietTopping_Topping` (`MaTopping`);

--
-- Chỉ mục cho bảng `dathang`
--
ALTER TABLE `dathang`
  ADD PRIMARY KEY (`MaDonHang`),
  ADD KEY `FK_NguoiDung_DatHang` (`MaNguoiDung`),
  ADD KEY `FK_DatHang_ChiNhanh` (`MaChiNhanh`);

--
-- Chỉ mục cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_GioHang_NguoiDung` (`MaNguoiDung`),
  ADD KEY `FK_GIOHANG_REFERENCE_SANPHAM` (`MaSanPham`),
  ADD KEY `FK_GIOHANG_REFERENCE_SIZE` (`MaSize`);

--
-- Chỉ mục cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  ADD PRIMARY KEY (`IdKhuyenMai`),
  ADD KEY `FK_KhuyenMai_SanPham` (`MaSanPham`);

--
-- Chỉ mục cho bảng `loaikhachhang`
--
ALTER TABLE `loaikhachhang`
  ADD PRIMARY KEY (`MaLoaiKH`);

--
-- Chỉ mục cho bảng `loaisanpham`
--
ALTER TABLE `loaisanpham`
  ADD PRIMARY KEY (`MaLoai`);

--
-- Chỉ mục cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD PRIMARY KEY (`MaNguoiDung`),
  ADD UNIQUE KEY `Uni_NguoiDung_SDT` (`SDTLienHe`),
  ADD UNIQUE KEY `Uni_NguoiDung_SDTDangNhap` (`SDTDangNhap`),
  ADD KEY `FK_NguoiDung_LoaiKH` (`MaLoaiKH`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`MaNhanVien`),
  ADD UNIQUE KEY `Uni_NguoiDung_SDT` (`SDTLienHe`),
  ADD UNIQUE KEY `Uni_NhanVien_SDTDangNhap` (`SDTDangNhap`),
  ADD KEY `FK_NhanVien_ChiNhanh` (`MaChiNhanh`);

--
-- Chỉ mục cho bảng `nhanxet`
--
ALTER TABLE `nhanxet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_NhanXet_NguoiDung` (`MaNguoiDung`),
  ADD KEY `FK_NhanXet_SanPham` (`MaSanPham`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`MaSanPham`),
  ADD KEY `FK_SanPham_LoaiSP` (`MaLoai`);

--
-- Chỉ mục cho bảng `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`MaSize`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`SDTDangNhap`);

--
-- Chỉ mục cho bảng `thongbaochinhanh`
--
ALTER TABLE `thongbaochinhanh`
  ADD PRIMARY KEY (`IdThongBao`),
  ADD KEY `FK_ThongBao_ChiNhanh` (`MaChiNhanh`);

--
-- Chỉ mục cho bảng `thongbaonguoidung`
--
ALTER TABLE `thongbaonguoidung`
  ADD PRIMARY KEY (`IdThongBao`),
  ADD KEY `FK_ThongBao_NguoiDung` (`MaNguoiDung`);

--
-- Chỉ mục cho bảng `topping`
--
ALTER TABLE `topping`
  ADD PRIMARY KEY (`MaTopping`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chinhanh`
--
ALTER TABLE `chinhanh`
  MODIFY `MaChiNhanh` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `dathang`
--
ALTER TABLE `dathang`
  MODIFY `MaDonHang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `giohang`
--
ALTER TABLE `giohang`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  MODIFY `IdKhuyenMai` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `loaikhachhang`
--
ALTER TABLE `loaikhachhang`
  MODIFY `MaLoaiKH` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `loaisanpham`
--
ALTER TABLE `loaisanpham`
  MODIFY `MaLoai` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  MODIFY `MaNguoiDung` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `MaNhanVien` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `nhanxet`
--
ALTER TABLE `nhanxet`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `MaSanPham` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `thongbaochinhanh`
--
ALTER TABLE `thongbaochinhanh`
  MODIFY `IdThongBao` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `thongbaonguoidung`
--
ALTER TABLE `thongbaonguoidung`
  MODIFY `IdThongBao` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `topping`
--
ALTER TABLE `topping`
  MODIFY `MaTopping` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitietdathang`
--
ALTER TABLE `chitietdathang`
  ADD CONSTRAINT `FK_CTDH_DatHang` FOREIGN KEY (`MaDonHang`) REFERENCES `dathang` (`MaDonHang`),
  ADD CONSTRAINT `FK_CTDH_SP` FOREIGN KEY (`MaSanPham`) REFERENCES `sanpham` (`MaSanPham`);

--
-- Các ràng buộc cho bảng `chitiettoppingdathang`
--
ALTER TABLE `chitiettoppingdathang`
  ADD CONSTRAINT `FK_ChiTietToppingDatHang_ChiTietDatHang` FOREIGN KEY (`MaSanPham`,`MaDonHang`) REFERENCES `chitietdathang` (`MaSanPham`, `MaDonHang`),
  ADD CONSTRAINT `FK_ChiTietToppingDatHang_Topping` FOREIGN KEY (`MaTopping`) REFERENCES `topping` (`MaTopping`);

--
-- Các ràng buộc cho bảng `chitiettoppinggiohang`
--
ALTER TABLE `chitiettoppinggiohang`
  ADD CONSTRAINT `FK_ChiTietTopping_GioHang` FOREIGN KEY (`ID`) REFERENCES `giohang` (`ID`),
  ADD CONSTRAINT `FK_ChiTietTopping_Topping` FOREIGN KEY (`MaTopping`) REFERENCES `topping` (`MaTopping`);

--
-- Các ràng buộc cho bảng `dathang`
--
ALTER TABLE `dathang`
  ADD CONSTRAINT `FK_NguoiDung_DatHang` FOREIGN KEY (`MaNguoiDung`) REFERENCES `nguoidung` (`MaNguoiDung`);

--
-- Các ràng buộc cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `FK_GioHang_NguoiDung` FOREIGN KEY (`MaNguoiDung`) REFERENCES `nguoidung` (`MaNguoiDung`),
  ADD CONSTRAINT `FK_GIOHANG_REFERENCE_SANPHAM` FOREIGN KEY (`MaSanPham`) REFERENCES `sanpham` (`MaSanPham`),
  ADD CONSTRAINT `FK_GIOHANG_REFERENCE_SIZE` FOREIGN KEY (`MaSize`) REFERENCES `size` (`MaSize`);

--
-- Các ràng buộc cho bảng `khuyenmai`
--
ALTER TABLE `khuyenmai`
  ADD CONSTRAINT `FK_KhuyenMai_SanPham` FOREIGN KEY (`MaSanPham`) REFERENCES `sanpham` (`MaSanPham`);

--
-- Các ràng buộc cho bảng `nguoidung`
--
ALTER TABLE `nguoidung`
  ADD CONSTRAINT `FK_NguoiDung_LoaiKH` FOREIGN KEY (`MaLoaiKH`) REFERENCES `loaikhachhang` (`MaLoaiKH`),
  ADD CONSTRAINT `FK_NguoiDungTaiKhoan` FOREIGN KEY (`SDTDangNhap`) REFERENCES `taikhoan` (`SDTDangNhap`);

--
-- Các ràng buộc cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `FK_NhanVien_ChiNhanh` FOREIGN KEY (`MaChiNhanh`) REFERENCES `chinhanh` (`MaChiNhanh`),
  ADD CONSTRAINT `FK_NHhanVienTaiKhoan` FOREIGN KEY (`SDTDangNhap`) REFERENCES `taikhoan` (`SDTDangNhap`);

--
-- Các ràng buộc cho bảng `nhanxet`
--
ALTER TABLE `nhanxet`
  ADD CONSTRAINT `FK_NhanXet_NguoiDung` FOREIGN KEY (`MaNguoiDung`) REFERENCES `nguoidung` (`MaNguoiDung`),
  ADD CONSTRAINT `FK_NhanXet_SanPham` FOREIGN KEY (`MaSanPham`) REFERENCES `sanpham` (`MaSanPham`);

--
-- Các ràng buộc cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `FK_SanPham_LoaiSP` FOREIGN KEY (`MaLoai`) REFERENCES `loaisanpham` (`MaLoai`);

--
-- Các ràng buộc cho bảng `thongbaochinhanh`
--
ALTER TABLE `thongbaochinhanh`
  ADD CONSTRAINT `FK_ThongBao_ChiNhanh` FOREIGN KEY (`MaChiNhanh`) REFERENCES `chinhanh` (`MaChiNhanh`);
--
-- Đang đổ dữ liệu cho bảng `chinhanh`
--

INSERT INTO `chinhanh` (`MaChiNhanh`, `TenChiNhanh`, `DiaChi`, `SDT`) VALUES
(1, 'Chi Nhánh Lê Trọng Tấn - Tân Phú', '140, đường Lê Trọng Tấn, Quận Tân Phú, Thành phố Hồ Chí Minh', '962051080'),
(2, 'Chi nhánh Nguyễn Thị Tú', '240, Nguyễn Thị Tú, Bình Hưng Hòa B, Bình Tân, Thành phố Hồ Chí Minh', '9285763839');
--
-- Đang đổ dữ liệu cho bảng `size`
--

INSERT INTO `size` (`MaSize`, `TenSize`, `Gia`, `HinhAnh`) VALUES
('SL', 'Size L', 7000, 'SizeL.png'),
('SM', 'Size M', 0, 'SizeM.png');


--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`SDTDangNhap`, `MatKhau`, `LoaiTaiKhoan`) VALUES
('339836389', '$2y$10$FqKZS7xm/nGXaiuyo2TyHe6dtmaT6S95dT7PGL59JwgMuL1Ku19f6', 1),
('339836390', '$2y$10$zBa/gLRVNq/2YLNeMKr9wuZW1dNucvWWhYNgPEPOCkd30GVUbwORy', 1),
('339836399', '$2y$10$7XewnW5u.TmxwfrN1APAKeZgV5dCN.9lJJqqswWCcLhVJNqbOJ.R6', 0),
('984123456', '$2y$10$lJmN7iNoL0UUXlKPzZqq9uyqRT4RtiXoIi9W2ETJIsA/YRQ8S9hOG', 0);

--
-- Đang đổ dữ liệu cho bảng `topping`
--

INSERT INTO `topping` (`MaTopping`, `TenTopping`, `Gia`, `HinhAnh`) VALUES
(1, 'Thạch Nâu', 11000, 'ThachNau.png'),
(2, 'Thạch Cà Phê', 11000, 'ThachCaPhe.png'),
(3, 'Trân Châu Vải', 11000, 'TranChauVai.png'),
(4, 'Trân Châu Xoài', 11000, 'TranChauXoai.png');

--
-- Đang đổ dữ liệu cho bảng `loaikhachhang`
--

INSERT INTO `loaikhachhang` (`MaLoaiKH`, `TenLoaiKhach`, `UuDai`) VALUES
(1, 'Khách hàng thông thường', 0),
(2, 'Khách hàng thường xuyên', 5),
(3, 'Khách hàng thân thiết', 10);


--
-- Đang đổ dữ liệu cho bảng `loaisanpham`
--

INSERT INTO `loaisanpham` (`MaLoai`, `TenLoai`, `hinhanh`) VALUES
(1, 'Trà Sữa', 'TraSua.png'),
(2, 'Special Drinks', 'SpecialDrink.jpg'),
(3, 'Trà Trái Cây', 'TraTraiCay.jpg'),
(4, 'Trà Nguyên Chất', 'TraNguyenChat.jpg'),
(5, 'DefaultNoneCategory', 'LoaiSanPham.png');

INSERT INTO `nguoidung` (`MaNguoiDung`, `MaLoaiKH`, `TenNguoiDung`, `SDTDangNhap`, `SDTLienHe`, `Email`, `AnhDaiDien`, `GioiTinh`, `NgaySinh`) VALUES
(1, 3, 'Võ Nguyễn Duy Tân', '984123456', '984123456', 'duytantt9@gmail.com', 'PersonDefault.jpg', b'1', '2002-02-08'),
(2, 1, 'DUY TAN', '339836399', '339836399', 'duytantt9@gmail.com\r\n        ', 'PersonDefault.jpg', b'1', '2007-02-08');


--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`MaNhanVien`, `MaChiNhanh`, `TenNhanVien`, `SDTDangNhap`, `SDTLienHe`, `AnhDaiDien`, `GioiTinh`, `NgaySinh`, `NgayVaoLam`) VALUES
(1, 1, 'Võ Nguyễn Duy Tân', '339836389', '339836389', 'PersonDefault.jpg', b'1', '2002-02-08', '2020-02-10'),
(2, 2, 'DUY TÂN VÕ NGUYỄN', '339836390', '339836390', 'PersonDefault.jpg', b'1', '2009-11-19', '2023-05-03');

--
-- Chỉ mục cho các bảng đã đổ
--
INSERT INTO `sanpham` (`MaSanPham`, `TenSanPham`, `MaLoai`, `MoTa`, `LuotMua`, `HinhAnh`, `GiaBan`, `TrangThai`) VALUES
(1, 'Trà Alisan Trái Cây', 3, 'Trà thuần cho tinh thần an nhiên, vừa giải nhiệt lại chứa các chất ngăn chặn lão hóa.', 0, 'ALISAN_TraiCay.png', 54000, b'1'),
(2, 'Chanh Ai-yu và Trân Châu Trắng', 3, 'Vị chanh muối dùng kèm với thạch Ai-yu thanh mát và hạt trân châu trắng.', 0, 'ChanhAiyu_TranChauTrang-2.png', 52000, b'1'),
(3, 'Đào Hồng Mận Hạt É', 3, 'Vị thanh mát, chua ngọt thơm ngon, dùng với hạt é.', 0, 'DaoHongManHatE.png', 52000, b'1'),
(4, 'Trà Oolong Vải', 3, 'Trà Oolong thơm ngon hòa cùng với vị Vải thanh mát.', 0, 'OlongVaipng.png', 54000, b'1'),
(5, 'Trà Alisan Vải', 3, 'Trà Alisan đặc trưng hòa cùng vị Vải thanh mát.', 0, 'AlisanVai2png.png', 52000, b'1'),
(6, 'Trà Đen Đào', 3, 'Trà đen thơm đặc trưng hòa cùng hương vị Đào ngọt ngào.', 0, 'TraDaoDen.png', 54000, b'1'),
(7, 'Trà Xanh Đào', 3, 'Trà xanh thanh mát, hòa cùng hương vị Đào ngọt ngào.', 0, 'TraXanhDao.png', 54000, b'1'),
(8, 'Trà Bí Đao', 4, 'Trà bí đao ngọt ngào, thanh mát, giúp giải nhiệt tốt.', 0, 'TraBiDao2.png', 45000, b'1'),
(9, 'Trà Alisan', 4, 'Loại trà đặc trưng của vùng đồi núi A Lý ở Đài Loan, vị trà thanh nhẹ, hơi chát.', 0, 'TraAlisan2.png', 45000, b'1'),
(10, 'Trà Oolong', 4, 'Vị trà đậm và có mùi thơm đặc trưng.', 0, 'TraOolong2.png', 45000, b'1'),
(11, 'Trà Bí Đao Gong Cha', 2, 'Trà bí đao thanh mát, ngọt ngào kết hợp chung với lớp kem sữa mặn.', 0, 'TraBiDaoMilkfoam.png', 56000, b'1'),
(12, 'Trà Oolong Gong Cha', 2, 'Vị trà đậm và thơm kết hợp hòa quyện với lớp kem sữa mặn.', 0, 'TraOlongMilkfoam.png', 56000, b'0'),
(13, 'Trà Alisan Gong Cha', 2, 'Loại trà đặc trưng của vùng đồi núi Alisan ở Đài Loan, hương trà thơm hòa quyện cùng lớp kem sữa mặn.', 0, 'TraAlisanMilkfoam.png', 56000, b'1'),
(14, 'Strawberry Milk Tea', 1, 'Nguyên vị sữa béo béo, càng thêm ngất ngây', 0, 'TraXanhSuaDau.png', 60000, b'1'),
(15, 'Mint Choco Milk Tea', 1, 'Nguyên vị sữa béo béo, càng thêm ngất ngây', 0, 'MintChocoMilkTe.png', 59000, b'1'),
(16, 'Strawberry Cookie Milk Tea', 1, 'Nguyên vị sữa béo béo, càng thêm ngất ngây', 0, 'StrawberryCookieMilkTea.png', 70000, b'1');


--
-- Đang đổ dữ liệu cho bảng `dathang`
--

INSERT INTO `dathang` (`MaDonHang`, `MaNguoiDung`, `MaChiNhanh`, `TongTien`, `UuDai`, `GiaGiamCon`, `TrangThai`, `NgayMua`) VALUES
(6, 1, '140,Lê Trọng Tấn, quận Tân Phú, TP.Hồ Chí Minh', 126000, 10, 113400, b'1', '2023-05-20 22:17:09'),
(7, 1, '140,Lê Trọng Tấn, quận Tân Phú, TP.Hồ Chí Minh', 156000, 10, 140400, b'1', '2023-05-20 22:17:09'),
(8, 1, '140,Lê Trọng Tấn, quận Tân Phú, TP.Hồ Chí Minh', 176000, 10, 158400, b'1', '2023-05-23 02:47:15'),
(9, 2, '93,Tân Kỳ Tân Quí, Tân Phú, TP.HCM', 244000, 0, 244000, b'1', '2023-05-23 03:22:24'),
(10, 2, 'Tân Phú, TP.HCM', 151000, 0, 151000, b'1', '2023-05-23 03:31:01'),
(11, 2, 'Tan phu,tp.hcm', 129000, 0, 129000, b'1', '2023-05-23 03:33:05');


--
-- Đang đổ dữ liệu cho bảng `chitietdathang`
--

INSERT INTO `chitietdathang` (`MaSanPham`, `MaDonHang`, `SoLuong`, `GiaBan`, `KhuyenMai`, `GiamCon`, `MaSize`, `LuongDuong`, `LuongDa`) VALUES
(3, 6, 2, 104000, 0, 0, 'SM', 'ít đường', 'vừa đủ'),
(3, 10, 1, 52000, 0, 0, 'SM', 'nhiều đường', 'ít đá'),
(14, 7, 2, 120000, 0, 0, 'SL', 'nhiều đường', 'nhiều đá'),
(15, 8, 2, 118000, 0, 0, 'SL', 'nhiều đường', 'ít đá');

--
-- Đang đổ dữ liệu cho bảng `chitiettoppingdathang`
--

INSERT INTO `chitiettoppingdathang` (`MaSanPham`, `MaDonHang`, `MaTopping`, `Gia`) VALUES
(3, 6, 3, 11000),
(3, 10, 3, 11000),
(3, 10, 4, 11000),
(14, 7, 4, 11000),
(15, 8, 1, 11000),
(15, 8, 3, 11000);





--
-- Đang đổ dữ liệu cho bảng `khuyenmai`
--

INSERT INTO `khuyenmai` (`IdKhuyenMai`, `MaSanPham`, `NoiDung`, `ChiTiet`, `NgayBatDau`, `NgayKetThuc`, `HinhAnh`) VALUES
(1, 5, 'Khuyến mãi nhân ngày báo cao bất ổn', 15, '2023-05-18', '2023-05-31', 'qc_h1.png'),
(3, 8, 'Khuyến mãi chào hè', 20, '2023-05-21', '2023-06-10', 'KhuyenMai.jpg'),
(4, 15, 'Xả hàng lấy tiền học lại mọi người ơi.', 25, '2023-05-22', '2023-06-08', 'KhuyenMai_1.jpg');



--
-- Đang đổ dữ liệu cho bảng `nguoidung`
--


--
-- Đang đổ dữ liệu cho bảng `nhanxet`
--

INSERT INTO `nhanxet` (`id`, `MaNguoiDung`, `MaSanPham`, `NoiDung`, `DanhGia`, `NgayDang`) VALUES
(1, 1, 1, 'Ngon quá trời!!!!', 4, '2023-05-21 04:24:41');


--
-- Đang đổ dữ liệu cho bảng `sanpham`
--




COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
