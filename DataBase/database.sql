Use master
Create database QL_CUAHANGDIENMAY
Use QL_CUAHANGDIENMAY

-- Tạo bảng Category (Danh mục sản phẩm)
CREATE TABLE Category (
    category_id INT PRIMARY KEY,
    category_name NVARCHAR(100)
);

-- Tạo bảng Supplier (Nhà cung cấp)
CREATE TABLE Supplier (
    supplier_id INT PRIMARY KEY,
    supplier_name NVARCHAR(100),
    contact_person NVARCHAR(100),
    phone_number NVARCHAR(20),
    email NVARCHAR(100),
    address NVARCHAR(255)
);

-- Tạo bảng Product (Sản phẩm)
CREATE TABLE Product (
    product_id INT PRIMARY KEY,
    product_name NVARCHAR(100),
    brand NVARCHAR(100),
    category_id INT,
    supplier_id INT,
    price DECIMAL(18, 2),
	img NVARCHAR(100),
    stock_quantity INT,
    description NVARCHAR(MAX),
    specification NVARCHAR(MAX),
    FOREIGN KEY (category_id) REFERENCES Category(category_id),
    FOREIGN KEY (supplier_id) REFERENCES Supplier(supplier_id)
);

-- Tạo bảng Customer (Khách hàng)
CREATE TABLE Customer (
    customer_id INT PRIMARY KEY,
    customer_name NVARCHAR(100),
    address NVARCHAR(255),
    phone_number NVARCHAR(20),
    email NVARCHAR(100)
);

-- Tạo bảng Order (Đơn hàng)
CREATE TABLE Order_CusTomer (
    order_id INT PRIMARY KEY,
    customer_id INT,
	employee_id INT,
    order_date DATETIME,
    total_amount DECIMAL(18, 2),
    FOREIGN KEY (customer_id) REFERENCES Customer(customer_id)
);

--thêm khóa ngoại nhân viên vào hóa đơn
Alter table Order_CusTomer
add employee_id INT;

Alter table Order_CusTomer
add Constraint FK_order_employee Foreign key(employee_id) REFERENCES Employee(employee_id);

-- Tạo bảng Order_Detail (Chi tiết đơn hàng)
CREATE TABLE Order_Detail (
    order_detail_id INT PRIMARY KEY,
    order_id INT,
    product_id INT,
    quantity INT,
    unit_price DECIMAL(18, 2),
    FOREIGN KEY (order_id) REFERENCES Order_CusTomer(order_id),
    FOREIGN KEY (product_id) REFERENCES Product(product_id)
);

-- Tạo lại bảng Warranty (Bảo hành)
CREATE TABLE Warranty (
    warranty_id INT PRIMARY KEY,
    order_id INT,
    start_date DATE,
    end_date DATE,
    description NVARCHAR(MAX),
    FOREIGN KEY (order_id) REFERENCES Order_CusTomer(order_id)
);

-- Tạo bảng Employee (Nhân viên)
CREATE TABLE Employee (
    employee_id INT PRIMARY KEY,
    employee_name NVARCHAR(100),
    position NVARCHAR(100),
    salary DECIMAL(18, 2),
    hire_date DATE,
    phone_number NVARCHAR(20),
    email NVARCHAR(100)
);
