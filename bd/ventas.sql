
CREATE SCHEMA `ventas2` DEFAULT CHARACTER SET utf8mb4;
 
USE ventas2;
 
CREATE TABLE usuarios (

    id_usuario INT AUTO_INCREMENT,
    nombre VARCHAR(50),
    apellido VARCHAR(50),
    email VARCHAR(50),
    password TEXT(50),
    fechaCaptura DATE,
    PRIMARY KEY (id_usuario)

);
 
CREATE TABLE categorias (

    id_categoria INT AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    nombreCategoria VARCHAR(150),
    fechaCaptura DATE,
    PRIMARY KEY (id_categoria),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)

);
 
CREATE TABLE imagenes (

    id_imagen INT AUTO_INCREMENT,
    id_categoria INT NOT NULL,
    nombre VARCHAR(500),
    ruta VARCHAR(500),
    fechaSubida DATE,
    PRIMARY KEY (id_imagen),
    FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria)

);
 
CREATE TABLE articulos (

    id_producto INT AUTO_INCREMENT,
    id_categoria INT NOT NULL,
    id_imagen INT NOT NULL,
    id_usuario INT NOT NULL,
    nombre VARCHAR(50),
    descripcion VARCHAR(500),
    cantidad INT,
    precio FLOAT,
    fechaCaptura DATE,
    PRIMARY KEY (id_producto),
    FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria),
    FOREIGN KEY (id_imagen) REFERENCES imagenes(id_imagen),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)

);
 
CREATE TABLE clientes (

    id_cliente INT AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    nombre VARCHAR(200),
    apellido VARCHAR(200),
    cedula INT (10),
    direccion VARCHAR(200),
    email VARCHAR(200),
    telefono VARCHAR(200),
    PRIMARY KEY (id_cliente),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)

);
 
CREATE TABLE proveedores (

    id_proveedor INT AUTO_INCREMENT,
    id_usuario INT NOT NULL,
    nombre_empresa VARCHAR(200),
    direccion_empresa VARCHAR(200),
    email_empresa VARCHAR(200),
    telefono_empresa VARCHAR(200),
    PRIMARY KEY (id_proveedor),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)

);
 
                   

CREATE TABLE ventas (

    id_venta int not null,
    id_cliente INT,
    id_producto INT,
    id_usuario INT,
    precio FLOAT,
    fechaCompra DATE,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente),
    FOREIGN KEY (id_producto) REFERENCES articulos(id_producto),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)

);
 
 
CREATE TABLE compras (

    id_compra int not null,
    id_proveedor INT NOT NULL,
    id_producto INT NOT NULL,
    id_usuario INT NOT NULL,
    cantidad INT,
    descripcion VARCHAR(200),
    precio FLOAT,
    fechaCompra DATE,
    FOREIGN KEY (id_proveedor) REFERENCES proveedores(id_proveedor),
    FOREIGN KEY (id_producto) REFERENCES articulos(id_producto),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)

);