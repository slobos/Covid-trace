import streamlit as st
import numpy as np 
import pandas as pd 
from scipy.integrate import odeint
import plotly.express as px
import plotly.graph_objects as go

def deriv(y, t, N, beta, gamma):
    S, I, R = y
    dSdt = -beta * S * I / N
    dIdt = beta * S * I / N - gamma * I
    dRdt = gamma * I
    return dSdt, dIdt, dRdt
    
def sird_model(t, X, beta=1, delta=0.02, zeta=1/15):

    S, I, R, D = X
    S_prime = - beta * S * I
    I_prime = beta * S * I - zeta * I - delta * I
    R_prime = zeta * I
    D_prime = delta * I
    return S_prime, I_prime, R_prime, D_prime

def sird_ode_solver(y0, t_span, t_eval, beta=1, delta=0.02, zeta=1/14):
    solution_ODE = solve_ivp(
        fun=lambda t, y: sird_model(t, y, beta=beta, zeta=zeta, delta=delta), 
        t_span=t_span, 
        y0=y0,
        t_eval=t_eval,
        method='LSODA'
    )
    
    return solution_ODE

    
  
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
    
    fig = go.Figure()
    fig.add_trace(go.Scatter3d(x=t, y=S, z=t,
                    mode='lines',
                    name='Susceptibles'))
    fig.add_trace(go.Scatter3d(x=t, y=I, z=t,
                    mode='lines',
                    name='Infectados'))
    fig.add_trace(go.Scatter3d(x=t, y=R, z=t,
                    mode='lines',
                    name='Removidos'))    
    fig.add_shape(
            type="line",
            x0=0,
            y0=1200,
            x1=500,
            y1=1200,
            line=dict(
                color="MediumPurple",
                width=8,
                dash="dot")
            )                    
                    
    fig.update_layout(
        title=titulo + "  R0= " + str(R0) + "   beta= " + str(beta) + "    gamma= " + str(gamma),
        autosize=False,
        width=1250,
        height=500,
        hovermode='x',
        margin=dict(
            l=50,
            r=30,
            b=50,
            t=50,
            pad=2
        ),     
    )
    st.plotly_chart(fig, use_container_width=False)   


st.header('Modelo SIR para Covid-10 Ciudad de Córdoba')

est_i = st.text_input('Calculadora de estimación de Infectados. Ingresar INTERNADOS para un día determinado (Los internados son el 12% de los Infectados)', '1')
num = int(est_i)
est_i_num = num * 100 / 12

st.write('Cantidad Estimada de Infectados:', str(est_i_num))

# ## Escenario con Cuarentena con R_0 < 2.5

R0CC = st.slider(
     'Ingresar la Tasa de Contagio : ',
     1.0, 4.0, 1.2)
     
N = 1500000
I0, R0 = 35, 0
S0 = N - I0 - R0
gamma = 1./5
beta = R0CC * gamma     
plot_sir("SIR Córdoba", N, I0, R0CC, beta, gamma)


y0_sird = S0, I0, R0, 0  # SIRD IC array
