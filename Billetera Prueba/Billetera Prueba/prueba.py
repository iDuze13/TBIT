import tkinter as tk
from tkinter import messagebox
from tkinter import ttk
import json
import os
import re

def validar_dni(dni):
    return dni.isdigit() and len(dni) == 8

def validar_telefono(telefono):
    return telefono.isdigit() and len(telefono) == 10

def validar_email(email):
    # Validar el formato del correo electrónico usando una expresión regular
    return re.match(r"[^@]+@[^@]+\.[^@]+", email) is not None

def registrar_usuario():
    nombre = entry_nombre.get()
    apellido = entry_apellido.get()
    dni = entry_dni.get()
    telefono = entry_telefono.get()
    mail = entry_mail.get()
    contrasena = entry_contrasena.get()
    provincia = combobox_provincia.get()

    if not (nombre and apellido and dni and telefono and mail and contrasena and provincia):
        messagebox.showwarning("Advertencia", "Todos los campos son obligatorios")
        return

    if not validar_dni(dni):
        messagebox.showwarning("Advertencia", "DNI debe contener exactamente 8 números")
        return

    if not validar_telefono(telefono):
        messagebox.showwarning("Advertencia", "El teléfono debe contener exactamente 10 números")
        return

    if not validar_email(mail):
        messagebox.showwarning("Advertencia", "Correo electrónico no válido")
        return

    if len(contrasena) < 8:
        messagebox.showwarning("Advertencia", "La contraseña debe tener al menos 8 caracteres")
        return

    # Crear un diccionario con los datos del usuario
    usuario = {
        "Nombre": nombre,
        "Apellido": apellido,
        "DNI": dni,
        "Teléfono": telefono,
        "Email": mail,
        "Contraseña": contrasena,
        "Provincia": provincia
    }

    # Verificar si el archivo JSON existe y si no, crear una lista vacía
    if os.path.exists('UsuariosP.json'):
        try:
            with open('UsuariosP.json', 'r') as file:
                data = json.load(file)
                if not isinstance(data, list):
                    data = []
        except (json.JSONDecodeError, ValueError):
            data = []
    else:
        data = []

    # Agregar el nuevo usuario a la lista
    data.append(usuario)

    # Escribir los datos actualizados de vuelta al archivo JSON
    with open('UsuariosP.json', 'w') as file:
        json.dump(data, file, indent=4)

    messagebox.showinfo("Registro", "Registro exitoso")

# Crear la ventana principal
root = tk.Tk()
root.title("Formulario de Registro")

# Crear y colocar las etiquetas y campos de entrada
tk.Label(root, text="Nombre:").grid(row=0, column=0, padx=10, pady=5)
entry_nombre = tk.Entry(root)
entry_nombre.grid(row=0, column=1, padx=10, pady=5)

tk.Label(root, text="Apellido:").grid(row=1, column=0, padx=10, pady=5)
entry_apellido = tk.Entry(root)
entry_apellido.grid(row=1, column=1, padx=10, pady=5)

tk.Label(root, text="DNI:").grid(row=2, column=0, padx=10, pady=5)
entry_dni = tk.Entry(root)
entry_dni.grid(row=2, column=1, padx=10, pady=5)

tk.Label(root, text="Teléfono:").grid(row=3, column=0, padx=10, pady=5)
entry_telefono = tk.Entry(root)
entry_telefono.grid(row=3, column=1, padx=10, pady=5)

tk.Label(root, text="Email:").grid(row=4, column=0, padx=10, pady=5)
entry_mail = tk.Entry(root)
entry_mail.grid(row=4, column=1, padx=10, pady=5)

tk.Label(root, text="Contraseña:").grid(row=5, column=0, padx=10, pady=5)
entry_contrasena = tk.Entry(root, show="*")
entry_contrasena.grid(row=5, column=1, padx=10, pady=5)

tk.Label(root, text="Provincia:").grid(row=6, column=0, padx=10, pady=5)
provincias = ["Buenos Aires", "Catamarca", "Chaco", "Chubut", "Córdoba", "Corrientes", 
              "Entre Ríos", "Formosa", "Jujuy", "La Pampa", "La Rioja", "Mendoza", 
              "Misiones", "Neuquén", "Río Negro", "Salta", "San Juan", "San Luis", 
              "Santa Cruz", "Santa Fe", "Santiago del Estero", "Tierra del Fuego", 
              "Tucumán"]
combobox_provincia = ttk.Combobox(root, values=provincias, state='readonly')
combobox_provincia.grid(row=6, column=1, padx=10, pady=5)

# Crear y colocar el botón de registro
btn_registrar = tk.Button(root, text="Registrar", command=registrar_usuario)
btn_registrar.grid(row=7, column=0, columnspan=2, pady=10)

# Ejecutar el bucle principal de la ventana
root.mainloop()
