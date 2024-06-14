import tkinter as tk
from tkinter import messagebox
from PIL import Image, ImageTk
from tkinter import ttk
from datetime import datetime
import json
import os

# Variables globales
saldo = 0.0
historial = []
archivo_historial = "historial.json"

# Funciones de la billetera
def cargar_historial():
    global saldo, historial
    if os.path.exists(archivo_historial):
        with open(archivo_historial, 'r') as file:
            data = json.load(file)
            saldo = data.get('saldo', 0.0)
            historial = data.get('historial', [])
            actualizar_historial()
            saldo_entry.config(state='normal')
            saldo_entry.delete(0, tk.END)
            saldo_entry.insert(0, f"{saldo:.2f}")
            saldo_entry.config(state='readonly')

def guardar_historial():
    with open(archivo_historial, 'w') as file:
        json.dump({"saldo": saldo, "historial": historial}, file, indent=2)

def depositar():
    global saldo
    try:
        monto = float(entry_monto.get())
        if monto > 0:
            saldo += monto
            saldo_entry.config(state='normal')
            saldo_entry.delete(0, tk.END)
            entry_monto.delete(0,tk.END)
            saldo_entry.insert(0, f"{saldo:.2f}")
            saldo_entry.config(state='readonly')
            historial.append({"tipo": "Depósito", "monto": monto, "fecha": datetime.now().strftime("%Y-%m-%d %H:%M:%S")})
            actualizar_historial()
            guardar_historial()
            messagebox.showinfo("Depósito", f"Has depositado ${monto:.2f}")
        else:
            messagebox.showwarning("Error", "El monto debe ser positivo")
    except ValueError:
        messagebox.showwarning("Error", "Por favor ingresa un monto válido")

def transferencia():
    root.destroy()
    from Transferencia import transfe
    transfe()

def agenda():
    root.destroy()
    from Modulo_Agenda import Inicio
    Inicio()

def retirar():
    global saldo
    try:
        monto = float(entry_monto.get())
        if monto > 0:
            if monto <= saldo:
                saldo -= monto
                saldo_entry.config(state='normal')
                saldo_entry.delete(0, tk.END)
                saldo_entry.insert(0, f"{saldo:.2f}")
                saldo_entry.config(state='readonly')
                entry_monto.delete(0,tk.END)
                historial.append({"tipo": "Retiro", "monto": monto, "fecha": datetime.now().strftime("%Y-%m-%d %H:%M:%S")})
                actualizar_historial()
                guardar_historial()
                messagebox.showinfo("Retiro", f"Has retirado ${monto:.2f}")
            else:
                messagebox.showwarning("Error", "Fondos insuficientes")
        else:
            messagebox.showwarning("Error", "El monto debe ser positivo")
    except ValueError:
        messagebox.showwarning("Error", "Por favor ingresa un monto válido")

def VerSaldo():
    global mostrar_icono, ocultar_icono
    if saldo_entry.cget('show') == '':  # Si el parámetro 'show' del Entry está vacío
        saldo_entry.config(show='*')  # Cambiar a mostrar caracteres ocultos
        BotonVer.config(image=mostrar_icono)  # Cambiar el ícono del botón
    else:
        saldo_entry.config(show='')  # Dejar de ocultar caracteres
        BotonVer.config(image=ocultar_icono)  # Cambiar el ícono del botón

def volver():
    respuesta = messagebox.askokcancel("Atención","Desea volver a la \npantalla principal?" )
    if respuesta:
        root.destroy()
        from Interfaz import interfaz
        interfaz()

def actualizar_historial():
    for i in historial_treeview.get_children():
        historial_treeview.delete(i)
    for transaccion in historial:
        historial_treeview.insert("", tk.END, text=transaccion["fecha"], values=(transaccion["tipo"], f'${transaccion["monto"]:.2f}'))

def int_Mov():
    global historial_treeview, entry_monto, saldo_entry, root, mostrar_icono, ocultar_icono, BotonVer
    root = tk.Tk()
    root.title("Cerberus Wallet")
    root.wm_iconbitmap("icono.ico")

    wtotal = root.winfo_screenwidth()
    htotal = root.winfo_screenheight()
    wventana = 425
    hventana = 700

    pwidth = round(wtotal/2-wventana/2)
    pheight = round(htotal/2-hventana/2)

    root.geometry(f"{wventana}x{hventana}+{pwidth}+{pheight}")

    FondoMovimiento = Image.open("Movimientos.png")
    FondoMovimiento = ImageTk.PhotoImage(FondoMovimiento)

    canvas = tk.Canvas(root, width=FondoMovimiento.width(), height=FondoMovimiento.height())
    canvas.pack()
    canvas.create_image(0, 0, anchor=tk.NW, image=FondoMovimiento)

    depo_icono = ImageTk.PhotoImage(Image.open("Depo.png"))
    extraccion_icono = ImageTk.PhotoImage(Image.open("Ext.png"))
    transferencia_icono = ImageTk.PhotoImage(Image.open("Transfe.png"))
    volver_icono = ImageTk.PhotoImage(Image.open("Cerrar.png"))
    mostrar_icono = ImageTk.PhotoImage(Image.open("ojo abierto.png"))
    ocultar_icono = ImageTk.PhotoImage(Image.open("ojo cerrado.png"))
    icono_agenda= ImageTk.PhotoImage(Image.open("ag.png"))

    entry_monto = tk.Entry(canvas, width= 10, font=("Helvetica", 15))
    entry_monto.place(x=150, y=235)

    boton_agregar = tk.Button(canvas, image=icono_agenda, command= agenda, border=0, bg="#B0DBEB")
    boton_agregar.place(x=275,y=608)

    boton_depositar = tk.Button(canvas, image= depo_icono, command=depositar, border=0, bg="#B0DBEB")
    boton_depositar.place(x=85, y=410)

    boton_retirar = tk.Button(canvas, image= extraccion_icono, command=retirar, border= 0, bg="#B0DBEB")
    boton_retirar.place(x=85, y=335)

    boton_transf = tk.Button(canvas, image= transferencia_icono, command= transferencia, border=0, bg="#B0DBEB")
    boton_transf.place(x=85, y=275)

    saldo_entry = tk.Entry(canvas, font=("Helvetica", 15), justify='center', show='*', width= 16)
    saldo_entry.insert(0, f"{saldo:.2f}")
    saldo_entry.config(state='readonly')
    saldo_entry.place(x=120, y=525)
    
    label_mov = tk.Label(canvas, text="Ultimos Movimientos", font=13)
    label_mov.place(x=130,y=10)

    historial_treeview = ttk.Treeview(canvas, selectmode="browse", columns=("a", "b"), height=7)

    verScrollBar = ttk.Scrollbar(canvas, orient="vertical", command=historial_treeview.yview, style="Vertical.TScrollbar")
    verScrollBar.place(x=376, y=47, height=170)

    estilo_scroll = ttk.Style()
    estilo_scroll.configure("Vertical.TScrollbar", width=20)  # Cambia el grosor de la scrollbar

    historial_treeview.column("#0", width=140)
    historial_treeview.column("a", width=80, anchor="center")
    historial_treeview.column("b", width=110, anchor="center")

    historial_treeview.heading("#0", text="Fecha")
    historial_treeview.heading("a", text="Movimiento")
    historial_treeview.heading("b", text="Monto")

    historial_treeview.configure(yscrollcommand=verScrollBar.set)
    historial_treeview.place(x=40, y=48)

    BotonVer = tk.Button(canvas, image=mostrar_icono, command=VerSaldo, bg="#B0DBEB", border=0)
    BotonVer.place(x=315, y=515)

    boton_volver = tk.Button(canvas, image= volver_icono, command=volver, bg="#B0DBEB", border=0)
    boton_volver.place(x=85, y=608)
    cargar_historial()

    root.mainloop()
if __name__ == "__main__":
    int_Mov()