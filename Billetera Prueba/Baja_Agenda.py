import tkinter as tk
import json
from tkinter import messagebox
from PIL import Image, ImageTk

def Borrar():

    def actualizar_listbox():
        lista_agenda_lb.delete(0, tk.END)
        for usu in lista_agenda:
            nombre = usu["Nombre"]
            CBU = usu["CBU"]
            lista_agenda_lb.insert(tk.END, f"Nombre: {nombre} - CBU: {CBU}")

    def eliminar_usu():
        indices_seleccionados = lista_agenda_lb.curselection()
        for indice in reversed(indices_seleccionados):
            lista_agenda_lb.delete(indice)
            del lista_agenda[indice]
        guardar_agenda()
        actualizar_listbox()

    def confirmar_eliminacion():
        respuesta = messagebox.askokcancel("Confirmar Eliminación", "¿Está seguro de eliminar la información seleccionada?")
        if respuesta:
            eliminar_usu()

    def cargar_agenda():
        global lista_agenda
        try:
            with open("Agenda.json", "r") as archivo:
                lista_agenda = json.load(archivo)
        except FileNotFoundError:
            lista_agenda = []

    def guardar_agenda():
        with open("Agenda.json", "w") as archivo:
            json.dump(lista_agenda, archivo, indent=2)

    def volver():
        root.destroy()
        from Modulo_Agenda import Inicio
        Inicio()

    root = tk.Tk()
    root.title("Cerberus Wallet")
    root.config(bg="#e9c126")
    root.wm_iconbitmap("icono.ico")

    wtotal = root.winfo_screenwidth()
    htotal = root.winfo_screenheight()
    wventana = 425
    hventana = 700

    pwidth = round(wtotal/2-wventana/2)
    pheight = round(htotal/2-hventana/2)

    root.geometry(f"{wventana}x{hventana}+{pwidth}+{pheight}")

    FondoBaja = Image.open("agenda.png")
    FondoBaja = ImageTk.PhotoImage(FondoBaja)
    
    icono_volver= ImageTk.PhotoImage(Image.open("volver.png"))
    icono_eliminar= ImageTk.PhotoImage(Image.open("eliminar.png"))

    canvas = tk.Canvas(root, width=FondoBaja.width(), height=FondoBaja.height())
    canvas.pack()
    canvas.create_image(0, 0, anchor=tk.NW, image=FondoBaja)

    boton_volver = tk.Button(root, image= icono_volver, command=volver, bg="#e9c126", border= 0)
    boton_volver.place(x=85, y=300)

    boton_borrar = tk.Button(root, image=icono_eliminar, command=confirmar_eliminacion, bg="#e9c126", border=0)
    boton_borrar.place(x=275, y=300)

    lista_agenda_lb = tk.Listbox(root, width=50, height=11, selectmode=tk.MULTIPLE)
    lista_agenda_lb.place(x=60, y=70)

    barra = tk.Scrollbar(root, orient=tk.VERTICAL)
    barra.place(x=363, y=70, height=180)
    lista_agenda_lb.config(yscrollcommand=barra.set)
    barra.config(command=lista_agenda_lb.yview)

    cargar_agenda()
    actualizar_listbox()

    root.mainloop()