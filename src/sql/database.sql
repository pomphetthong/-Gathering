-- สร้างฐานข้อมูล
CREATE DATABASE IF NOT EXISTS mydatabase CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE mydatabase;

-- สร้างตารางผู้สมัคร
CREATE TABLE IF NOT EXISTS applicants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    room VARCHAR(20) NOT NULL,
    sop TEXT NOT NULL,
    club VARCHAR(50) NOT NULL,
    status INT DEFAULT 0 COMMENT '0=รอดำเนินการ, 1=ผ่าน, 2=ไม่ผ่าน',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ตารางผู้สมัคร IT support
CREATE TABLE IF NOT EXISTS applicants_it_support (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    room VARCHAR(20) NOT NULL,
    sop TEXT NOT NULL,
    status INT DEFAULT 0 COMMENT '0=รอดำเนินการ, 1=ผ่าน, 2=ไม่ผ่าน',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ตารางผู้สมัคร RoboTech
CREATE TABLE IF NOT EXISTS applicants_robotech (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    room VARCHAR(20) NOT NULL,
    sop TEXT NOT NULL,
    status INT DEFAULT 0 COMMENT '0=รอดำเนินการ, 1=ผ่าน, 2=ไม่ผ่าน',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ตารางผู้สมัคร Full Stack Dev
CREATE TABLE IF NOT EXISTS applicants_fullstackdev (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    room VARCHAR(20) NOT NULL,
    sop TEXT NOT NULL,
    status INT DEFAULT 0 COMMENT '0=รอดำเนินการ, 1=ผ่าน, 2=ไม่ผ่าน',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ตารางผู้สมัคร Programmer
CREATE TABLE IF NOT EXISTS applicants_programmer (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    room VARCHAR(20) NOT NULL,
    sop TEXT NOT NULL,
    status INT DEFAULT 0 COMMENT '0=รอดำเนินการ, 1=ผ่าน, 2=ไม่ผ่าน',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- เพิ่มข้อมูลตัวอย่าง (ถ้าต้องการ)
INSERT INTO applicants (name, room, sop, club, status) VALUES
('สมชาย ใจดี', 'ม.4/1', 'สนใจด้าน IT และต้องการเรียนรู้การเขียนโปรแกรม', 'Programmer', 0),
