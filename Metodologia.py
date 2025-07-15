import tkinter as tk

datos = {
    'Lunes': 10,
    'Martes': 20,
    'Miércoles': 15,
    'Jueves': 8,
    'Viernes': 12
}

# Configuración de ventana
ventana = tk.Tk()
ventana.title("Gráfico de Barras")
canvas = tk.Canvas(ventana, width=500, height=300)
canvas.pack()

# Configuración del gráfico
ancho_barra = 40
espacio = 30
x_inicio = 50
altura_max = 200

max_valor = max(datos.values())

for i, (dia, valor) in enumerate(datos.items()):
    x0 = x_inicio + i * (ancho_barra + espacio)
    y0 = 250 - (valor / max_valor * altura_max)
    x1 = x0 + ancho_barra
    y1 = 250

    # Dibujar barra
    canvas.create_rectangle(x0, y0, x1, y1, fill="skyblue")

    # Etiqueta de valor
    canvas.create_text((x0 + x1) / 2, y0 - 10, text=str(valor), font=("Arial", 10))

    # Etiqueta de día
    canvas.create_text((x0 + x1) / 2, 270, text=dia, font=("Arial", 10), anchor="n")

# Ejecutar ventana
ventana.mainloop()

