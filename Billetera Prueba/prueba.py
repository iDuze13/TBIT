import tkinter as tk
from tkinter import messagebox

def pruebaaa():
    # Variables globales
    saldo = 0.0

    # Funciones de la billetera
    def depositar():
        global saldo
        try:
            monto = float(entry_monto.get())
            if monto > 0:
                saldo += monto
                label_saldo.config(text=f"Saldo: ${saldo:.2f}")
                messagebox.showinfo("Depósito", f"Has depositado ${monto:.2f}")
            else:
                messagebox.showwarning("Error", "El monto debe ser positivo")
        except ValueError:
            messagebox.showwarning("Error", "Por favor ingresa un monto válido")

    def retirar():
        global saldo
        try:
            monto = float(entry_monto.get())
            if monto > 0:
                if monto <= saldo:
                    saldo -= monto
                    label_saldo.config(text=f"Saldo: ${saldo:.2f}")
                    messagebox.showinfo("Retiro", f"Has retirado ${monto:.2f}")
                else:
                    messagebox.showwarning("Error", "Fondos insuficientes")
            else:
                messagebox.showwarning("Error", "El monto debe ser positivo")
        except ValueError:
            messagebox.showwarning("Error", "Por favor ingresa un monto válido")

    def consultar_saldo():
        messagebox.showinfo("Saldo", f"Tu saldo actual es ${saldo:.2f}")

    # Configuración de la interfaz gráfica
    root = tk.Tk()
    root.title("Billetera Virtual")

    label_saldo = tk.Label(root, text="Saldo: $0.00", font=("Arial", 14))
    label_saldo.pack(pady=10)

    entry_monto = tk.Entry(root, font=("Arial", 12))
    entry_monto.pack(pady=10)

    button_depositar = tk.Button(root, text="Depositar", font=("Arial", 12), command=depositar)
    button_depositar.pack(pady=5)

    button_retirar = tk.Button(root, text="Retirar", font=("Arial", 12), command=retirar)
    button_retirar.pack(pady=5)

    button_consultar = tk.Button(root, text="Consultar Saldo", font=("Arial", 12), command=consultar_saldo)
    button_consultar.pack(pady=5)

    root.mainloop()
pruebaaa()