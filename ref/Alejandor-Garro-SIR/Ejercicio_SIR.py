import streamlit as st
import numpy as np 
import pandas as pd 
from scipy.integrate import odeint
import plotly.express as px
import plotly.graph_objects as go
from base64 import b64encode

def dataframe_to_base64(df: pd.DataFrame) -> str:
    csv = df.to_csv(index=False)
    b64 = b64encode(csv.encode()).decode()
    return b64
    
def display_download_link(st, filename: str, df: pd.DataFrame):
    csv = dataframe_to_base64(df)
    st.markdown(
        """
        <a download="{filename}" href="data:file/csv;base64,{csv}">Descargar {filename}</a>
        """.format(
            csv=csv, filename=filename
        ),
        unsafe_allow_html=True,
    )

def deriv(y, t, N, beta, gamma):
    S, I, R = y
    dSdt = -beta * S * I / N
    dIdt = beta * S * I / N - gamma * I
    dRdt = gamma * I
    return dSdt, dIdt, dRdt

def diez_porciento(x):
    z= 5*x/100
    return z

def porcent_fallecidos(x):
    z= 20*x/100
    return z
  
def plot_sir(titulo, N, I0, R0, beta, gamma):
    R_0 = beta / gamma   
    t = np.linspace(0, 550 , 800)
    y0 = S0, I0, R0

    ret = odeint(deriv, y0, t, args=(N, beta, gamma))
    S, I, R = ret.T
    
    S = [round(x,0) for x in S] 
    I = [round(x,0) for x in I] 
    R = [round(x,0) for x in R]  
    t = [round(x,0) for x in t]       
    uti = [round(diez_porciento(x),0) for x in I]
    F = [round(porcent_fallecidos(x),0) for x in uti]

    df['t']= t    
    df['S']= S
    df['I']= I
    df['R']= R
    df['Casos_Severos']= uti
    df['Fallecidos']=F
    
          
    fig = go.Figure()
    fig.add_trace(go.Scatter(x=t, y=S,
                    mode='lines',
                    name='Susceptibles'))
                    
    fig.add_trace(go.Scatter(x=t, y=I,
                    mode='lines+markers',
                    name='Infectados',
                    opacity=0.5,
                    fill='toself',
                    marker=dict(
                        color='red',
                        symbol='circle-dot',
                        size=5),
                    line=dict(color='red', width=1, dash='dot',shape='spline')
                    ))

    fig.add_trace(go.Scatter(x=t, y=R,
                    mode='lines',
                    name='Removidos'))                   

    fig.add_trace(go.Scatter(x=t, y=uti,
                    mode='lines+markers',
                    name='Casos Severos',
                    opacity=0.5,
                    fill='toself',
                    marker=dict(
                        color='purple',
                        symbol='circle-dot',
                        size=5),
                    line=dict(color='purple', width=1, dash='dot',shape='spline')
                    ))

    fig.add_trace(go.Scatter(x=t, y=F,
                    mode='lines+markers',
                    name='Fallecidos',
                    opacity=0.5,
                    fill='toself',
                    marker=dict(
                        color='black',
                        symbol='circle-dot',
                        size=5),
                    line=dict(color='black', width=1, dash='dot',shape='spline')
                    ))
                
    fig.add_shape(
            # Line Horizontal
                type="line",
                x0=0,
                y0=saturacion,
                x1=500,
                y1=saturacion,
                line=dict(
                    color="blue",
                    width=1,
                    dash="dot",
                ),
        )
    fig.add_shape(
            # Line Vertical
                type="line",
                x0=20,
                y0=0,
                x1=20,
                y1=1.6e6,
                line=dict(
                    color="blue",
                    width=1,
                    dash="dot",
                ),
        )        
    fig.update_xaxes(showspikes=True, spikethickness=1)
    fig.update_yaxes(showspikes=True, spikethickness=1)       
                    
    fig.update_layout(
        title=titulo + "  R0= " + str(R0) + "   beta= " + str(beta) + "    gamma= " + str(gamma),
        autosize=False,
        width=1250,
        template='plotly_white',
        height=500,
        hovermode='x',
        margin=dict(
            l=50,
            r=30,
            b=50,
            t=50,
            pad=2
        ),
        annotations=[
        dict(
            x=20,
            y=1.2e6,
            xref="x",
            yref="y",
            text="Comienzo de la Cuarentena",
            showarrow=True,
            arrowhead=7,
            ax=20,
            ay=-40
        )],     
    )
    st.plotly_chart(fig, use_container_width=False)   

saturacion = 1200
recuperacion = 7

df = pd.DataFrame()

hide_menu_style = """
        <style>
        #MainMenu {visibility: hidden;}
        </style>
        """

st.markdown(hide_menu_style, unsafe_allow_html=True)  

from PIL import Image
image = Image.open('logo-muni1.png')
st.sidebar.image(image,use_column_width=False)

st.header('Modelo SIR para Covid-10 Ciudad de Córdoba')
st.sidebar.text('PASO 1: nro. Internados acumulados')
st.sidebar.text('PASO 2: estimar Infectados')

est_i = st.sidebar.text_input('Calculadora de estimación de Infectados. Ingresar INTERNADOS para un día determinado (Los internados son el 12% de los Infectados)', '1')
num = int(est_i)
est_i_num = num * 100 / 12
zz=str(round(est_i_num,0))
st.sidebar.text('Infectados:' + zz )
st.sidebar.text('PASO 3: ajustar tasa de contagio.')
st.sidebar.text('PASO 4: que coincida el estimado de')
st.sidebar.text('        Infectados Estimado y el día')
st.sidebar.text('        de la epidemia con el de la curva.')
st.sidebar.text('--------------------------------------- ')
st.sidebar.text('(Un 10% de los confirmados con')
st.sidebar.text('Covid-19 son internados.')
st.sidebar.text('De acuerdo con el CDC estos casos')
st.sidebar.text('representan aproximadamente el 12%')
st.sidebar.text('de los infectados sean detectados')
st.sidebar.text('o no.')
st.sidebar.text('')



# ## Escenario con Cuarentena con R_0 < 2.5

R0CC = st.slider(
     'R0: Ingresar la Tasa de Contagio para CALIBRAR la curva SIR ',
     1.0, 5.0, 2.2)
saturacion =  st.slider(
     'Cantidad Máxima de camas con respirador :',
     100.0, 15000.0, 1200.0)    

recuperacion = st.slider(
     'Gamma: Ingresar Cantidad de días promedio de recuperación ',
     1.0, 25.0, 7.0)     
     
N = 1500000
I0, R0 = 35, 0
S0 = N - I0 - R0
gamma = 1./recuperacion
beta = R0CC * gamma     
plot_sir("SIR Córdoba", N, I0, R0CC, beta, gamma)

display_download_link(
    st,
    filename="modelo_SIR_ciudad_cordoba.csv",
    df=df,
) 

# ## Escenario sin Cuarentena con R_0 = 2.5 
R0SC =  2.5
N = 1500000
I0, R0 = 35, 0
S0 = N - I0 - R0
gamma = 1./recuperacion
beta = R0SC * gamma     
plot_sir("Ciudad de Córdoba - Escenario Sin Cuarentena", N, I0, R0SC, beta, gamma)

