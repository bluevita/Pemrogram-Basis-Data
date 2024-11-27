SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS kebugaran;

show DATABASES;

USE kebugaran;

CREATE TABLE user (
    id_user INT(11) NOT NULL AUTO_INCREMENT,    
    role INT(11) NOT NULL,                        
    nama VARCHAR(50) NOT NULL UNIQUE,                
    email VARCHAR(50) NOT NULL UNIQUE,           
    tgl_lahir DATE NOT NULL,                      
    jenis_kelamin CHAR(1) NOT NULL,                
    password VARCHAR(300) NOT NULL,                
    tgl_daftar DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_user)                          
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DESCRIBE user;

INSERT INTO user (role, nama, email, tgl_lahir, jenis_kelamin, password)
VALUES
(0, 'Admin', 'admin@kebugaran.com', '1985-06-15', 'M', 'adminganteng123');

INSERT INTO user (role, nama, email, tgl_lahir, jenis_kelamin, password)
VALUES
(2, 'Dr. Ahmad Yani', 'ahmad.yani@kebugaran.com', '1980-06-25', 'L', 'Ahmad12345'),
(2, 'Dr. Fira Lestari', 'fira.lestari@kebugaran.com', '1978-09-12', 'P', 'Fira12345'),
(2, 'Dr. Tommy Setiawan', 'tommy.setiawan@kebugaran.com', '1982-02-14', 'L', 'Tommy12345'),
(2, 'Dr. Sarah Pratama', 'sarah.pratama@kebugaran.com', '1985-12-05', 'P', 'Sarah12345'),
(2, 'Dr. Kevin Wijaya', 'kevin.wijaya@kebugaran.com', '1979-10-20', 'L', 'Kevin12345');

INSERT INTO user (role, nama, email, tgl_lahir, jenis_kelamin, password)
VALUES
(1, 'Ravi Pratama', 'ravi.pratama@gmail.com', '1993-05-15', 'L', 'Ravi54321'),
(1, 'Tina Kartika', 'tina.kartika@gmail.com', '1991-11-25', 'P', 'Tina54321'),
(1, 'Andi Susanto', 'andi.susanto@gmail.com', '1989-03-30', 'L', 'Andi54321'),
(1, 'Maya Sari', 'maya.sari@gmail.com', '1995-07-10', 'P', 'Maya54321'),
(1, 'Budi Setiawan', 'budi.setiawan@gmail.com', '1992-08-18', 'L', 'Budi54321');

SELECT * FROM user;

CREATE TABLE gejala (
    id_gejala INT(11) NOT NULL AUTO_INCREMENT,      
    gejala VARCHAR(100) NOT NULL UNIQUE,                  
    deskripsi TEXT NOT NULL,                        
    tingkat_frekuensi INT(11) NOT NULL,              
    kategori_gejala VARCHAR(50) NOT NULL,           
    PRIMARY KEY (id_gejala)                         
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DESCRIBE gejala;

INSERT INTO gejala (gejala, deskripsi, tingkat_frekuensi, kategori_gejala)
VALUES
('Keletihan atau lelah berlebihan', 'Merasa sangat lelah meskipun setelah istirahat yang cukup', 4, 'Serius'),
('Sering merasa nyeri otot', 'Nyeri yang dirasakan pada otot tubuh setelah aktivitas fisik', 3, 'Serius'),
('Susah tidur atau insomnia', 'Kesulitan tidur meskipun merasa sangat lelah', 5, 'Serius'),
('Mudah sesak napas', 'Sesak napas saat melakukan aktivitas ringan seperti berjalan cepat', 2, 'Ringan'),
('Kehilangan motivasi untuk olahraga', 'Tidak ada keinginan untuk berolahraga meskipun sebelumnya rutin', 4, 'Serius'),
('Pusing atau vertigo', 'Rasa pusing yang bisa disertai dengan kehilangan keseimbangan', 3, 'Ringan'),
('Mual atau muntah', 'Merasa mual yang disertai dengan keinginan untuk muntah', 3, 'Ringan'),
('Kelemahan otot', 'Kelemahan pada otot tubuh yang menyebabkan kesulitan bergerak', 4, 'Serius'),
('Depresi atau kecemasan', 'Perasaan cemas atau tertekan yang berlangsung dalam waktu lama', 5, 'Serius'),
('Gangguan pencernaan', 'Kesulitan dalam pencernaan, seperti perut kembung atau sembelit', 4, 'Serius');

SELECT * FROM gejala;

CREATE TABLE penyakit (
    id_penyakit INT(11) NOT NULL AUTO_INCREMENT,     
    penyakit VARCHAR(100) NOT NULL UNIQUE,                  
    kategori VARCHAR(50) NOT NULL,                   
    tingkat_keparahan INT(11) NOT NULL,             
    pengobatan TEXT NOT NULL,                        
    PRIMARY KEY (id_penyakit)                       
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DESCRIBE penyakit;

INSERT INTO penyakit (penyakit, kategori, tingkat_keparahan, pengobatan)
VALUES
('Fatigue Syndrome', 'Gangguan Kebugaran', 4, 'Istirahat yang cukup, pengelolaan stres, dan pola hidup sehat'),
('Overtraining Syndrome', 'Gangguan Kebugaran', 5, 'Mengurangi intensitas latihan dan meningkatkan pemulihan'),
('Sleep Disorder', 'Gangguan Tidur', 3, 'Perbaikan kebiasaan tidur, penggunaan terapi perilaku kognitif'),
('Hypertension', 'Gangguan Kesehatan Umum', 5, 'Menurunkan konsumsi garam, olahraga teratur, dan konsumsi obat antihipertensi');

SELECT * FROM penyakit;

CREATE TABLE relasi (
    id_relasi INT(11) NOT NULL AUTO_INCREMENT,      
    gejala VARCHAR(100) NOT NULL,                   
    penyakit VARCHAR(100) NOT NULL,                 
    deskripsi_relasi VARCHAR(300) NOT NULL UNIQUE,         
    tingkat_keterkaitan INT(11) NOT NULL,           
    PRIMARY KEY (id_relasi),                         
    FOREIGN KEY (gejala) REFERENCES gejala(gejala), 
    FOREIGN KEY (penyakit) REFERENCES penyakit(penyakit) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DESCRIBE relasi;

INSERT INTO relasi (gejala, penyakit, deskripsi_relasi, tingkat_keterkaitan)
VALUES
('Keletihan atau lelah berlebihan', 'Fatigue Syndrome', 'Keletihan berlebihan adalah gejala utama pada Fatigue Syndrome', 5),
('Sering merasa nyeri otot', 'Overtraining Syndrome', 'Nyeri otot adalah gejala yang sering muncul pada Overtraining Syndrome', 4),
('Susah tidur atau insomnia', 'Sleep Disorder', 'Insomnia terkait langsung dengan gangguan tidur', 5),
('Mudah sesak napas', 'Hypertension', 'Sesak napas sering terjadi pada penderita hipertensi', 3),
('Kehilangan motivasi untuk olahraga', 'Fatigue Syndrome', 'Kehilangan motivasi terkait dengan Fatigue Syndrome', 4),
('Pusing atau vertigo', 'Overtraining Syndrome', 'Pusing dapat terjadi pada penderita Overtraining Syndrome', 4),
('Mual atau muntah', 'Hypertension', 'Mual dapat menjadi gejala hipertensi', 3),
('Kelemahan otot', 'Fatigue Syndrome', 'Kelemahan otot terjadi pada Fatigue Syndrome', 4),
('Gangguan pencernaan', 'Hypertension', 'Gangguan pencernaan terjadi pada penderita hipertensi', 5),
('Depresi atau kecemasan', 'Sleep Disorder', 'Depresi adalah gejala umum pada Sleep Disorder', 5);

SELECT * FROM relasi;

CREATE TABLE solusi (
    id_solusi INT(11) NOT NULL AUTO_INCREMENT,    
    penyakit VARCHAR(100) NOT NULL,                   
    deskripsi_relasi VARCHAR(300) NOT NULL, 
    solusi TEXT NOT NULL,                            
    metode_pengobatan VARCHAR(100) NOT NULL,         
    PRIMARY KEY (id_solusi),                         
    FOREIGN KEY (penyakit) REFERENCES penyakit(penyakit),
    FOREIGN KEY (deskripsi_relasi) REFERENCES relasi(deskripsi_relasi)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DESCRIBE solusi;

-- Menambahkan solusi untuk penyakit
INSERT INTO solusi (penyakit, deskripsi_relasi, solusi, metode_pengobatan)
VALUES
('Fatigue Syndrome', 'Keletihan berlebihan adalah gejala utama pada Fatigue Syndrome', 
 'Istirahat cukup, pengaturan pola makan sehat, dan pengelolaan stres.', 'Medis'),
('Overtraining Syndrome', 'Nyeri otot adalah gejala yang sering muncul pada Overtraining Syndrome', 
 'Mengurangi intensitas latihan dan meningkatkan waktu pemulihan.', 'Alami'),
('Sleep Disorder', 'Insomnia terkait langsung dengan gangguan tidur', 
 'Terapi perilaku kognitif untuk meningkatkan kualitas tidur.', 'Medis'),
('Hypertension', 'Sesak napas sering terjadi pada penderita hipertensi', 
 'Menurunkan konsumsi garam, olahraga teratur, dan konsumsi obat antihipertensi.', 'Medis');

SELECT * FROM solusi;

-- View untuk melihat gejala yang terkait dengan penyakit
CREATE VIEW GejalaPenyakitView AS
SELECT r.gejala, r.penyakit, r.deskripsi_relasi, r.tingkat_keterkaitan
FROM relasi r;

CREATE VIEW SolusiView AS
SELECT s.penyakit, s.deskripsi_relasi, s.solusi, s.metode_pengobatan
FROM solusi s;

-- handling error di dalam stored procedure:
DELIMITER $$

CREATE PROCEDURE UpdateUserPassword(IN user_id INT, IN new_password VARCHAR(300))
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
        ROLLBACK;  -- Rollback jika terjadi error

    START TRANSACTION;

    UPDATE user
    SET password = new_password
    WHERE id_user = user_id;

    COMMIT;  -- Commit jika berhasil
END $$

DELIMITER ;

-- Stored Procedure untuk Mengambil Informasi Pengguna Berdasarkan Role
DELIMITER $$

CREATE PROCEDURE GetUsersByRole(IN user_role INT)
BEGIN
    SELECT * FROM user WHERE role = user_role;
END $$

DELIMITER ;

CALL GetUsersByRole(2);

SHOW PROCEDURE STATUS;

DELIMITER $$

CREATE PROCEDURE GetGejalaByKategori_gejala(IN Kategori_gejala_filter VARCHAR(50))
BEGIN
    SELECT * FROM gejala WHERE kategori_gejala = Kategori_gejala_filter;
END $$

DELIMITER ;

CALL GetGejalaByKategori_gejala("Mental");

drop PROCEDURE GetGejalaByKategori_gejala;

DELIMITER $$

CREATE PROCEDURE CountPenyakitsByTingkatKeparahan(IN Hitung_tingkat_keparahan INT)
BEGIN
    DECLARE Jumlah_penyakit INT;
    
    -- Menghitung jumlah penyakit dengan tingkat keparahan tertentu
    SELECT COUNT(*) INTO Jumlah_penyakit 
    FROM penyakit 
    WHERE tingkat_keparahan = Hitung_tingkat_keparahan;
    
    -- Menampilkan hasil jumlah penyakit
    SELECT Jumlah_penyakit AS TotalPenyakit;
END $$

DELIMITER ;

CALL CountPenyakitsByTingkatKeparahan(5);

DELIMITER $$

CREATE PROCEDURE GetAllRelasi()
BEGIN
    -- Menampilkan semua data relasi
    SELECT * FROM relasi;
END $$

DELIMITER ;
CALL GetAllRelasi();


DELIMITER $$

CREATE PROCEDURE GetSolusiByPenyakit(IN penyakit_name VARCHAR(100))
BEGIN
    SELECT solusi, metode_pengobatan 
    FROM solusi 
    WHERE penyakit = penyakit_name;
END $$

DELIMITER ;

CALL GetSolusiByPenyakit('Overtraining Syndrome');


-- Function untuk Mengambil Nama Pengguna Berdasarkan ID
DELIMITER $$

CREATE FUNCTION GetUserNameByID(id INT) 
RETURNS VARCHAR(50)
DETERMINISTIC
BEGIN
    DECLARE userName VARCHAR(50);
    
    -- Mendapatkan nama berdasarkan id_user
    SELECT nama INTO userName 
    FROM user 
    WHERE id_user = id;
    
    -- Jika tidak ditemukan, mengembalikan NULL
    IF userName IS NULL THEN
        RETURN 'User Not Found';
    END IF;
    
    RETURN userName;
END $$

DELIMITER ;

SELECT GetUserNameByID(1);

-- Function untuk Menghitung Jumlah Gejala yang Terkait dengan Penyakit
DELIMITER $$

CREATE FUNCTION CountGejalaByPenyakit(penyakit_name VARCHAR(100))
RETURNS INT
DETERMINISTIC
BEGIN
    DECLARE jumlahGejala INT;
    
    -- Menghitung jumlah gejala yang terhubung dengan penyakit tertentu di tabel relasi
    SELECT COUNT(*) INTO jumlahGejala 
    FROM relasi 
    WHERE penyakit = penyakit_name;
    
    -- Mengembalikan jumlah gejala
    RETURN jumlahGejala;
END $$

DELIMITER ;

SELECT CountGejalaByPenyakit('Hypertension');

DELIMITER $$

CREATE FUNCTION GetPenyakitByID(id INT)
RETURNS VARCHAR(200)
DETERMINISTIC
BEGIN
    DECLARE penyakit_info VARCHAR(200);
    
    -- Mengambil nama penyakit dan pengobatan berdasarkan id_penyakit
    SELECT CONCAT(penyakit, ' - ', pengobatan) INTO penyakit_info
    FROM penyakit 
    WHERE id_penyakit = id;
    
    -- Mengembalikan informasi penyakit
    RETURN penyakit_info;
END $$

DELIMITER ;

SELECT GetPenyakitByID(1);

DELIMITER $$

CREATE FUNCTION GetDeskripsiByTingkatKeterkaitan()
RETURNS TEXT
DETERMINISTIC
BEGIN
    DECLARE result TEXT;

    -- Mengambil semua deskripsi relasi dengan tingkat keterkaitan lebih dari 4
    SELECT GROUP_CONCAT(deskripsi_relasi SEPARATOR '; ') INTO result
    FROM relasi
    WHERE tingkat_keterkaitan > 4;

    -- Jika tidak ada data, mengembalikan pesan kosong
    IF result IS NULL THEN
        RETURN 'Tidak ada relasi dengan tingkat keterkaitan lebih dari 4';
    END IF;

    RETURN result;
END $$

DELIMITER ;

SELECT GetDeskripsiByTingkatKeterkaitan();

DELIMITER $$

CREATE FUNCTION GetSolusiByPenyakit(penyakit_name VARCHAR(100))
RETURNS TEXT
DETERMINISTIC
BEGIN
    DECLARE solusi_info TEXT;

    -- Mengambil solusi berdasarkan nama penyakit
    SELECT solusi INTO solusi_info
    FROM solusi
    WHERE penyakit = penyakit_name;

    -- Jika solusi ditemukan, kembalikan hasil
    IF solusi_info IS NOT NULL THEN
        RETURN solusi_info;
    ELSE
        -- Jika tidak ada solusi ditemukan, kembalikan pesan
        RETURN 'Solusi tidak ditemukan untuk penyakit tersebut.';
    END IF;
END $$

DELIMITER ;

SELECT GetSolusiByPenyakit('Fatigue Syndrome');


DELIMITER $$

drop TRIGGER notify_admin_role_change;
CREATE TRIGGER notify_admin_role_change
AFTER UPDATE ON user
FOR EACH ROW
BEGIN
    DECLARE message_text VARCHAR(255);
    
    -- Mengecek apakah role berubah menjadi 'admin' (role = 0)
    IF NEW.role = 0 AND OLD.role != 0 THEN
        -- Menyimpan pesan dalam variabel
        SET message_text = CONCAT('Role has been changed to Admin for user ', NEW.nama);
        
        -- Menggunakan SIGNAL untuk menampilkan pesan
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = message_text;
    END IF;
END $$

DELIMITER ;

UPDATE user
SET role = 0
WHERE id_user = 5;

DELIMITER $$

CREATE TRIGGER update_kategori_gejala
BEFORE UPDATE ON gejala
FOR EACH ROW
BEGIN
    -- Mengecek dan mengubah kategori_gejala berdasarkan tingkat_frekuensi
    IF NEW.tingkat_frekuensi > 3 THEN
        SET NEW.kategori_gejala = 'Serius';
    ELSE
        SET NEW.kategori_gejala = 'Ringan';
    END IF;
END $$

DELIMITER ;

UPDATE gejala
SET tingkat_frekuensi = 5
WHERE id_gejala = 1;

DELIMITER $$

CREATE TRIGGER check_tingkat_keparahan
BEFORE INSERT ON penyakit
FOR EACH ROW
BEGIN
    -- Mengecek apakah tingkat_keparahan lebih dari 5
    IF NEW.tingkat_keparahan > 5 THEN
        -- Mencegah penyimpanan jika tingkat_keparahan lebih dari 5
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Tingkat keparahan tidak boleh lebih dari 5';
    END IF;
END $$

DELIMITER ;

INSERT INTO penyakit (penyakit, kategori, tingkat_keparahan, pengobatan)
VALUES ('Stroke', 'Gangguan Kesehatan Umum', 6, 'Perawatan intensif dan terapi fisik');

DELIMITER $$

CREATE TRIGGER check_tingkat_keterkaitan
BEFORE INSERT ON relasi
FOR EACH ROW
BEGIN
    -- Mengecek apakah tingkat_keterkaitan lebih besar dari 0
    IF NEW.tingkat_keterkaitan <= 0 THEN
        -- Membatalkan penyisipan data dan menampilkan pesan kesalahan
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Tingkat keterkaitan harus lebih besar dari 0';
    END IF;
END $$

DELIMITER ;

INSERT INTO relasi (gejala, penyakit, deskripsi_relasi, tingkat_keterkaitan)
VALUES
('Susah tidur atau insomnia', 'Sleep Disorder', 'Insomnia terkait langsung dengan gangguan tidur', 0);

DELIMITER $$

CREATE TRIGGER check_solusi_empty
BEFORE INSERT ON solusi
FOR EACH ROW
BEGIN
    -- Mengecek apakah kolom solusi kosong
    IF NEW.solusi IS NULL OR TRIM(NEW.solusi) = '' THEN
        -- Membatalkan penyisipan data dan menampilkan pesan kesalahan
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Solusi tidak boleh kosong';
    END IF;
END $$

DELIMITER ;

INSERT INTO solusi (penyakit, deskripsi_relasi, solusi, metode_pengobatan)
VALUES
('Sleep Disorder', 'Insomnia terkait langsung dengan gangguan tidur',  '', 'Medis');

show TABLES;

ALTER TABLE user
ADD INDEX idx_role (role);

DESCRIBE user

ALTER TABLE gejala
ADD INDEX idx_gejala (gejala);

ALTER TABLE relasi
ADD CONSTRAINT fk_gejala
FOREIGN KEY (gejala) REFERENCES gejala(gejala);

DESCRIBE gejala;

ALTER TABLE penyakit
ADD INDEX idx_penyakit (penyakit);

ALTER TABLE penyakit
ADD CONSTRAINT fk_penyakit_relasi
FOREIGN KEY (penyakit) REFERENCES relasi(penyakit);

ALTER TABLE penyakit
ADD CONSTRAINT fk_penyakit_solusi
FOREIGN KEY (penyakit) REFERENCES solusi(penyakit);

DESCRIBE penyakit;

ALTER TABLE solusi
ADD CONSTRAINT fk_solusi_relasi
FOREIGN KEY (deskripsi_relasi) REFERENCES relasi(deskripsi_relasi);

DESCRIBE relasi;

INSERT INTO user (role, nama, email, tgl_lahir, jenis_kelamin, password)
VALUES
(0, 'Admin_2', 'admin_2@kebugaran.com', '2003-06-15', 'A', 'adminganteng123');

UPDATE user
SET jenis_kelamin = 'L'
WHERE nama = 'Admin';

SELECT * FROM user;

DELETE FROM user
WHERE email = 'admin_2@kebugaran.com';

drop PROCEDURE GetUsersByRole;

SELECT * 
FROM user
ORDER BY nama ASC;

SELECT * 
FROM gejala
ORDER BY gejala DESC;

SELECT * 
FROM user
WHERE nama LIKE '%A%';

SELECT penyakit, kategori
FROM penyakit;

CREATE INDEX idx_penyakit ON penyakit(penyakit);
SELECT * FROM penyakit WHERE penyakit = 'Fatigue Syndrome';

SELECT g.gejala, p.penyakit
FROM gejala g
JOIN relasi r ON g.gejala = r.gejala
JOIN penyakit p ON r.penyakit = p.penyakit
WHERE r.tingkat_keterkaitan > 3;

SELECT * FROM gejala ORDER BY tingkat_frekuensi DESC LIMIT 5;



/*START TRANSACTION;

INSERT INTO user (role, nama, email, tgl_lahir, jenis_kelamin, password)
VALUES (1, 'coba aja dlu', 'boy.sasa@example.com', '2000-01-01', 'L', '212131234234523');

SELECT * FROM user;

ROLLBACK;

-- Mengonfirmasi transaksi sehingga data yang disisipkan menjadi permanen
COMMIT;*/

-- --------------------------------------------------------
-- Menyelesaikan transaksi.
IF ERROR_OCCURRED THEN
    -- Jika ada error, rollback perubahan
    ROLLBACK;
ELSE
    -- Jika tidak ada error, commit perubahan
    COMMIT;
END IF;

COMMIT;