import tkinter as tk
from tkinter import messagebox
from PIL import Image, ImageTk
import json
from Cajero import int_Mov

def salir():
    marco.destroy()

def VerPass():
    global mostrar_icono, ocultar_icono
    if entrada_contraseña.cget('show') == '':
        entrada_contraseña.config(show='*')
        BotonVer.config(image=mostrar_icono)
    else:
        entrada_contraseña.config(show='')
        BotonVer.config(image=ocultar_icono)

def verificar_credenciales():
    usuario = entrada_usuario.get()
    contraseña = entrada_contraseña.get()

    if usuario in Usuarios:
        if Usuarios[usuario]["contraseña"] == contraseña:
            messagebox.showinfo("Éxito", "Inicio de sesión exitoso")
            marco.destroy()
            int_Mov()
        else:
            messagebox.showerror("Error", "Contraseña incorrecta")
    else:
        messagebox.showerror("Error", "Usuario no encontrado")

def registrar_usuario():
    usuario = entrada_usuario.get()
    contraseña = entrada_contraseña.get()

    if usuario and contraseña:
        if usuario not in Usuarios:
            Usuarios[usuario] = {"contraseña": contraseña}
            with open("usuarios.json", "w") as archivo:
                json.dump(Usuarios, archivo, indent=2)
            messagebox.showinfo("Éxito", "Usuario registrado correctamente")
            entrada_usuario.delete(0, tk.END)
            entrada_contraseña.delete(0, tk.END)
        else:
            messagebox.showerror("Error", "Usuario ya existe")
    else:
        messagebox.showerror("Error", "No puede quedar vacío")

def recuperar_credenciales():
    usuario = entrada_usuario.get()

    if usuario in Usuarios:
        contraseña = Usuarios[usuario]["contraseña"]
        messagebox.showinfo("Recuperación de credenciales", f"Usuario: {usuario}\nContraseña: {contraseña}")
    else:
        messagebox.showerror("Error", "Usuario no encontrado")

try:
    with open("usuarios.json", "r") as archivo:
        Usuarios = json.load(archivo)
except FileNotFoundError:
    Usuarios = {}
    with open("usuarios.json", "w") as archivo:
        json.dump(Usuarios, archivo)

def interfaz():
    global marco, entrada_usuario, entrada_contraseña, BotonVer
    global mostrar_icono, ocultar_icono

    marco = tk.Tk()
    marco.title("Cerberus Wallet")
    marco.wm_iconbitmap("icono.ico")
    
    wtotal = marco.winfo_screenwidth()
    htotal = marco.winfo_screenheight()
    wventana = 425
    hventana = 700

    pwidth = round(wtotal/2-wventana/2)
    pheight = round(htotal/2-hventana/2)

    marco.geometry(f"{wventana}x{hventana}+{pwidth}+{pheight}")

    FondoInicio = Image.open("Interfaz.png")
    FondoInicio = ImageTk.PhotoImage(FondoInicio)

    canvas = tk.Canvas(marco, width=FondoInicio.width(), height=FondoInicio.height())
    canvas.pack()
    canvas.create_image(0, 0, anchor=tk.NW, image=FondoInicio)

    entrada_usuario = tk.Entry(canvas, font=25, width=12)
    entrada_usuario.place(x=180, y=340)

    entrada_contraseña = tk.Entry(canvas, show="*", font=25, width=12)
    entrada_contraseña.place(x=180, y=450)

    inicio_icono = ImageTk.PhotoImage(Image.open("Inicio.png"))
    registro_icono = ImageTk.PhotoImage(Image.open("Registro.png"))

    boton_ingresar = tk.Button(canvas, image=inicio_icono, command=verificar_credenciales, bg="#B0DBEB", border=0)
    boton_ingresar.place(x=80, y=612)

    boton_registrarse = tk.Button(canvas, image=registro_icono, command=registrar_usuario, bg="#B0DBEB", border=0)
    boton_registrarse.place(x=230, y=612)

    mostrar_icono = ImageTk.PhotoImage(Image.open("ojo abierto.png"))
    ocultar_icono = ImageTk.PhotoImage(Image.open("ojo cerrado.png"))

    BotonVer = tk.Button(canvas, image=mostrar_icono, command=VerPass, bg="#B0DBEB", border=0)
    BotonVer.place(x=189, y=520)

    recuperar_icono = ImageTk.PhotoImage(Image.open("3e9079cf-82a6-4d6d-a7ee-10ade66ed7f0.png"))  # Icono para el botón de recuperación
    boton_recuperar = tk.Button(canvas, image=recuperar_icono, command=recuperar_credenciales, bg="#B0DBEB", border=0)
    boton_recuperar.place(x=165, y=580)

    marco.mainloop()

if __name__ == "__main__":
    interfaz()