import tkinter as tk  
import json  
from tkinter import messagebox  
from PIL import Image, ImageTk

def Modificar():
    def actualizar_listbox():
        lista_agenda_lb.delete(0, tk.END)
        for usu in lista_agenda:
            nombre = usu["Nombre"]
            CBU = usu["CBU"]
            lista_agenda_lb.insert(tk.END, f"Nombre: {nombre} - CBU: {CBU}")

    def modificar_contacto():
        seleccion = lista_agenda_lb.curselection()
        if seleccion:
            indice = seleccion[0]
            usuario_seleccionada = lista_agenda[indice]  # Aquí corregimos

            ventana_modificar = tk.Toplevel(root)
            ventana_modificar.title("Modificar Usuarios")

            tk.Label(ventana_modificar, text="Nuevo Nombre:").place(x=10, y=5)
            nuevo_nombre_entry = tk.Entry(ventana_modificar)
            nuevo_nombre_entry.place(x= 10, y=30)
            nuevo_nombre_entry.insert(0, usuario_seleccionada["Nombre"])

            tk.Label(ventana_modificar, text="Nuevo CBU:").place(x=10, y=50)
            nuevo_numero_entry = tk.Entry(ventana_modificar)
            nuevo_numero_entry.place(x=10, y=75)
            nuevo_numero_entry.insert(0, usuario_seleccionada["CBU"])

            # Función para aplicar los cambios al producto
            def aplicar_cambios():
                try:    
                    usuario_seleccionada["Nombre"] = nuevo_nombre_entry.get()
                    usuario_seleccionada["CBU"] = int(nuevo_numero_entry.get())
                    actualizar_listbox()
                    ventana_modificar.destroy()
                except:
                    messagebox.showerror("Error!", "Ingrese solo numeros")
                guardar_usuario()

            # Botón para aplicar los cambios
            tk.Button(ventana_modificar, text="Aplicar Cambios", command=aplicar_cambios).place(x=10, y=100)

    def cargar_usuario():
        global lista_agenda
        try:
            with open("Agenda.json", "r") as archivo:
                lista_agenda = json.load(archivo)
        except FileNotFoundError:
            lista_agenda = []

    def guardar_usuario():
        with open("Agenda.json", "w") as archivo:
            json.dump(lista_agenda, archivo, indent=2)

    def volver():
        root.destroy()
        from Modulo_Agenda import Inicio
        Inicio()

    root = tk.Tk()
    root.title("Cerberus Wallet")
    root.config(bg="#B0DBEB")
    root.wm_iconbitmap("icono.ico")

    wtotal = root.winfo_screenwidth()
    htotal = root.winfo_screenheight()
    wventana = 425
    hventana = 380

    pwidth = round(wtotal/2-wventana/2)
    pheight = round(htotal/2-hventana/2)

    root.geometry(f"{wventana}x{hventana}+{pwidth}+{pheight}")

    FondoBaja = Image.open("Agenda_Ch.png")
    FondoBaja = ImageTk.PhotoImage(FondoBaja)

    canvas = tk.Canvas(root, width=FondoBaja.width(), height=FondoBaja.height())
    canvas.pack()
    canvas.create_image(0, 0, anchor=tk.NW, image=FondoBaja)

    icono_modificar = ImageTk.PhotoImage(Image.open("modificar.png"))
    icono_volver = ImageTk.PhotoImage(Image.open("volver.png"))

    boton_borrar = tk.Button(root, image= icono_modificar, command=modificar_contacto, bg="#B0DBEB", border= 0)
    boton_borrar.place(x=275, y=300)

    boton_volver = tk.Button(root, image= icono_volver, command=volver, bg="#B0DBEB", border= 0)
    boton_volver.place(x=70, y=300)

    lista_agenda_lb = tk.Listbox(root, width=50, height=11, selectmode=tk.MULTIPLE)
    lista_agenda_lb.place(x=60, y=75)

    barra = tk.Scrollbar(root, orient=tk.VERTICAL)
    barra.place(x=364, y=75, height=180)
    lista_agenda_lb.config(yscrollcommand=barra.set)
    barra.config(command=lista_agenda_lb.yview)

    cargar_usuario()
    actualizar_listbox()

    root.mainloop()
