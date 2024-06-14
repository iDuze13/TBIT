import tkinter as tk
from tkinter import messagebox
from PIL import Image, ImageTk
import Agregar_Agenda
import Baja_Agenda
import Modificar_Agenda
import Cajero
import Interfaz

def modulo():
    opcion_seleccionada = eleccion.get()
    if opcion_seleccionada == "Agregar":
        marco.destroy()
        Agregar_Agenda.Agregar()
    elif opcion_seleccionada == "Modificar":
        marco.destroy()
        Modificar_Agenda.Modificar()
    elif opcion_seleccionada == "Eliminar":
        marco.destroy()
        Baja_Agenda.Borrar()

def pantalla_anterior():
    respuesta = messagebox.askokcancel("¡Atención!", "Desea volver a\nla pantalla anterior?")
    if respuesta:
        marco.destroy()
        Cajero.int_Mov()

def pantalla_inicio():
    respuesta = messagebox.askokcancel("¡Atención!", "Desea volver a\nla pantalla principal?")
    if respuesta:
        marco.destroy()
        Interfaz.interfaz()

def Inicio():
    global marco
    global FondoInicio
    global eleccion
    marco = tk.Tk()
    marco.title("Cerberus Wallet")
    marco.wm_iconbitmap("icono.ico")

    wtotal = marco.winfo_screenwidth()
    htotal = marco.winfo_screenheight()
    wventana = 425
    hventana = 380

    pwidth = round(wtotal/2-wventana/2)
    pheight = round(htotal/2-hventana/2)

    marco.geometry(f"{wventana}x{hventana}+{pwidth}+{pheight}")

    FondoInicio = Image.open("Agenda_Ch.png")
    FondoInicio = ImageTk.PhotoImage(FondoInicio)

    canvas = tk.Canvas(marco, width=FondoInicio.width(), height=FondoInicio.height())
    canvas.pack()
    canvas.create_image(0, 0, anchor=tk.NW, image=FondoInicio)

    icono_vol= ImageTk.PhotoImage(Image.open("volver.png"))
    icono_cerrar = ImageTk.PhotoImage(Image.open("Cerrar.png"))
    icono_seleccion = ImageTk.PhotoImage(Image.open("sel.png"))

    eleccion = tk.StringVar()
    opciones_eleccion = tk.OptionMenu(marco, eleccion, "Agregar", "Modificar", "Eliminar")
    opciones_eleccion.place(x=265, y=85)
    opciones_eleccion.config(font=("New York", 15), bg="#B0DBEB")

    boton_elegir = tk.Button(marco, image= icono_seleccion, command=modulo, border= 0, bg="#B0DBEB")
    boton_elegir.place(x=240, y=135)

    label_eleccion = tk.Label(canvas, text="Elija la opción deseada", font=("New York", 15), bg="#B0DBEB")
    label_eleccion.place(x=60, y=90)

    boton_volver = tk.Button(image= icono_vol, command=pantalla_anterior, border=0, bg="#B0DBEB")
    boton_volver.place(x=20, y=290)

    boton_pantalla_inicio = tk.Button(image= icono_cerrar ,command=pantalla_inicio, border=0, bg="#B0DBEB")
    boton_pantalla_inicio.place(x=275, y=290)
    marco.mainloop()

if __name__ == "__main__":
    Inicio()
