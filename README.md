# Sistema de Gestión de Inventario y Ventas para Cafetería

Este es un sistema de gestión de inventario desarrollado en PHP usando el patrón MVC (Modelo-Vista-Controlador). Permite gestionar productos, realizar ventas y actualizar el stock de los productos.

---

## **Requisitos del Sistema**

### **Versiones de Software**
- **PHP**: Versión 8.0 o superior.
- **Motor de Base de Datos**: SQL Server.
- **Autenticación de la Base de Datos**: Autenticación de SQL Server (usuario y contraseña).

### **Dependencias**
- **PDO_SQLSRV**: Extensión de PHP para conectarse a SQL Server.
- **Bootstrap**: CDN para el diseño de la interfaz de usuario.

---

## **Configuración del Proyecto**

### **1. Base de Datos**

#### **Crear la Base de Datos**
Crea una base de datos llamada `db_pt_salamanca` y ejecuta las siguientes sentencias SQL en tu servidor de SQL Server para crear las tablas necesarias:

```sql
-- Tabla de Categorías
CREATE TABLE categorias (
    id INT IDENTITY(1,1) PRIMARY KEY,
    nombre NVARCHAR(100) NOT NULL
);

-- Tabla de Productos
CREATE TABLE productos (
    id INT IDENTITY(1,1) PRIMARY KEY,
    nombre NVARCHAR(100) NOT NULL,
    referencia NVARCHAR(50) NOT NULL,
    precio INT NOT NULL,
    peso INT NOT NULL,
    categoria_id INT NOT NULL,
    stock INT NOT NULL,
    fecha_creacion DATE NOT NULL,
    fecha_actualizacion DATE NOT NULL,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
);

-- Tabla de Ventas
CREATE TABLE ventas (
    id INT IDENTITY(1,1) PRIMARY KEY,
    producto_id INT NOT NULL,
    cantidad INT NOT NULL,
    fecha_venta DATE NOT NULL,
    FOREIGN KEY (producto_id) REFERENCES productos(id)
);
```

#### **Insertar Registros Iniciales**
Ejecuta las siguientes sentencias SQL para insertar categorías de productos iniciales:

```sql
-- Insertar categorías de productos
INSERT INTO categorias (nombre) VALUES
('Bebidas Calientes'),
('Bebidas Frías'),
('Postres');
```

### **2. Levantar Servidor de Desarrollo**
Ejecuta el siguiente comando para levantar el servidor de desarrollo:

```bash
php -S localhost:8000
```

### **3. Abre la URL Activa**
Accede a la aplicación desde tu navegador usando la siguiente URL:

```
http://localhost:8000
```
```