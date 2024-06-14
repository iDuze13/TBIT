import tkinter as tk
from tkinter import messagebox
from PIL import Image, ImageTk
import json
from datetime import datetime
from Cajero import saldo, historial, archivo_historial

def cargar_usuario():
    global lista_agenda
    try:
        with open("Agenda.json", "r") as archivo:
            lista_agenda = json.load(archivo)
        
    except FileNotFoundError:
        lista_agenda = []

def actualizar_listbox():
    lista_agenda_lb.delete(0, tk.END)
    for usu in lista_agenda:
        nombre = usu["Nombre"]
        CBU = usu["CBU"]
        lista_agenda_lb.insert(tk.END, f"Nombre: {nombre} - CBU: {CBU}")

def guardar_historial():
    with open(archivo_historial, 'w') as file:
        json.dump({"saldo": saldo, "historial": historial}, file, indent=2)

def volver():
    respuesta = messagebox.askokcancel("Atención","Desea volver a la \npantalla anterior?" )
    if respuesta:
        root.destroy()
        from Cajero import int_Mov
        int_Mov()

def transferir_fondos():
    seleccion = lista_agenda_lb.curselection()
    if not seleccion:
        messagebox.showerror("Error", "Por favor selecciona una cuenta.")
        return

    indice = seleccion[0]
    cuenta_destino = lista_agenda[indice]

    ventana_transferir = tk.Toplevel(root)
    ventana_transferir.title("Cerberus Wallet")
    ventana_transferir.geometry("300x200")

    tk.Label(ventana_transferir, text="Monto a Transferir:").place(x=10, y=60)
    monto_transferir_entry = tk.Entry(ventana_transferir)
    monto_transferir_entry.place(x=150, y=60)

    def aplicar_transferencia():
        try:
            monto = float(monto_transferir_entry.get())

            global saldo_transfe
            if saldo_transfe < monto:
                messagebox.showerror("Error", "Saldo insuficiente en la cuenta principal.")
                return

            saldo_transfe -= monto

            historial.append({"tipo": "Transferencia", "monto": monto, "fecha": datetime.now().strftime("%Y-%m-%d %H:%M:%S")})

            actualizar_listbox()
            guardar_historial()
            ventana_transferir.destroy()
            messagebox.showinfo("Éxito", f"Se han transferido {monto} a {cuenta_destino['Nombre']}.")
        except ValueError:
            messagebox.showerror("Error", "Por favor ingresa un monto válido.")

    tk.Button(ventana_transferir, text="Aplicar Transferencia", command=aplicar_transferencia).place(x=100, y=100)

def transfe():
    global root, lista_agenda_lb, lista_agenda, saldo_transfe

    root = tk.Tk()
    root.title("Cerberus Wallet")
    root.wm_iconbitmap("icono.ico")

    wtotal = root.winfo_screenwidth()
    htotal = root.winfo_screenheight()
    wventana = 425
    hventana = 380

    pwidth = round(wtotal/2-wventana/2)
    pheight = round(htotal/2-hventana/2)

    root.geometry(f"{wventana}x{hventana}+{pwidth}+{pheight}")

    Fondotransferencia = Image.open("Agenda_Ch.png")
    Fondotransferencia = ImageTk.PhotoImage(Fondotransferencia)

    canvas = tk.Canvas(root, width=Fondotransferencia.width(), height=Fondotransferencia.height())
    canvas.pack(fill="both", expand=True)
    canvas.create_image(0, 0, anchor=tk.NW, image=Fondotransferencia)

    icono_transfe = ImageTk.PhotoImage(Image.open("Tr.png"))
    icono_volver= ImageTk.PhotoImage(Image.open("volver.png"))

    lista_agenda_lb = tk.Listbox(root, width=50, height=10)
    lista_agenda_lb.place(x=65, y= 80)
    
    transfer_button = tk.Button(root, image= icono_transfe, border=0, bg="#B0DBEB", command=transferir_fondos)
    transfer_button.place(x= 250, y= 285)
    volver_boton =tk.Button(canvas, image= icono_volver, border=0,bg="#B0DBEB", command=volver)
    volver_boton.place(x= 50, y= 285)
    
    # Asignación del valor modificado de saldo al saldo_transfe
    saldo_transfe = saldo

    cargar_usuario()
    actualizar_listbox()

    root.mainloop()

if __name__ == "__main__":
    transfe()
