import tkinter as tk
import json
from tkinter import messagebox
from PIL import Image, ImageTk

def Agregar():
    global FondoAlta
    global root
    global lista_agenda
    lista_agenda = []

    try:
        with open("Agenda.json", "r") as archivo:
            lista_agenda = json.load(archivo)
    except FileNotFoundError:
        lista_agenda = []

    def agregar_usu():
        agendar = entrada1.get().strip()
        if not agendar:
            messagebox.showerror(message="No se ha ingresado ningun nombre", title="¡Error!")
        elif not agendar.isalpha():
            messagebox.showerror(message="Solo puede ingresar letras", title="¡Error!")
        else:
            try:
                numero_cbu = int(entrada2.get().strip())
                lista_agenda.append({"Nombre": agendar, "CBU": numero_cbu})
                entrada1.delete(0, tk.END)
                entrada2.delete(0, tk.END)
                guardar_usu()
            except ValueError:
                messagebox.showerror(message="El CBU debe\n contener solo números", title="¡Error!")

    def volver_inicio():
        root.destroy()
        from Modulo_Agenda import Inicio
        Inicio()

    def guardar_usu():
        with open("Agenda.json", "w") as archivo:
            json.dump(lista_agenda, archivo, indent=2)
    
    root = tk.Tk()
    root.title("Cerberus Wallet")
    root.config(bg="#FFE4C4")
    root.wm_iconbitmap("icono.ico")

    wtotal = root.winfo_screenwidth()
    htotal = root.winfo_screenheight()
    wventana = 425
    hventana = 700

    pwidth = round(wtotal/2-wventana/2)
    pheight = round(htotal/2-hventana/2)

    root.geometry(f"{wventana}x{hventana}+{pwidth}+{pheight}")

    FondoAlta = Image.open("agenda.png")
    FondoAlta = ImageTk.PhotoImage(FondoAlta)

    icono_agregar = ImageTk.PhotoImage(Image.open("guardar.png"))
    icono_volver = ImageTk.PhotoImage(Image.open("volver.png"))
    icono_nombre = ImageTk.PhotoImage(Image.open("nombre.png"))
    icono_cbu = ImageTk.PhotoImage(Image.open("cbu.png"))

    canvas = tk.Canvas(root, width=FondoAlta.width(), height=FondoAlta.height())
    canvas.pack()
    canvas.create_image(0, 0, anchor=tk.NW, image=FondoAlta)

    texto = tk.Label(canvas, text="Nombre", bg="#e9c126", image= icono_nombre, border= 0)
    texto.place(x= 100, y= 100)
    entrada1 = tk.Entry(canvas, font=25, width=12)
    entrada1.place(x= 190, y= 110)

    texto2 = tk.Label(canvas, image= icono_cbu , bg="#e9c126", border= 0)
    texto2.place(x= 115, y=150)
    entrada2 = tk.Entry(canvas, font=25, width=12)
    entrada2.place(x=190, y=160)


    boton_añadir = tk.Button(canvas, image= icono_agregar , command=agregar_usu, bg="#e9c126", border= 0)
    boton_añadir.place(x=250, y=550)

    boton_regresar = tk.Button(canvas, image= icono_volver, command=volver_inicio, bg="#e9c126", border=0)
    boton_regresar.place(x=100, y=550)

    root.mainloop()
