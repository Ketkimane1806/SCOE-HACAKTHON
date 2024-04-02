import streamlit as st
import numpy as np
from keras.models import load_model
from keras.utils import img_to_array,load_img
import cv2
st.set_page_config(page_title="MASK DETECTION",page_icon="https://www.mobotix.com/sites/default/files/inline-images/Mx_App_FaceDetectDeep-AI_930x550.jpg")
facemodel=cv2.CascadeClassifier("face.xml")
maskmodel=load_model("mask.h5")
st.title("FACE MASK DETECTION SYSTEM")
st.sidebar.image("https://cdn.hackernoon.com/images/oO6rUouOWRYlzw88QM9pb0KyMIJ3-bxfy3m27.png")
choice=st.sidebar.selectbox("MENU",("HOME","IMAGE","WEBCAM","URL",""))
if(choice=="HOME"):
   st.image("https://via-vis.com/wp-content/uploads/2020/08/Mask-Detection-gif-1.gif")
   st.write("FACE MASK DETECTION SYSTEM IS COMPUTER VISION MACHIN LEARNING APPLICATION WHICH CAN BE ACCESSED THROUGH IP CAMERAS")
elif(choice=="IMAGE"):
   st.markdown('<center><h2>IMAGE DETECTION<h2></center>',unsafe_allow_html=True)
   file=st.file_uploader("Upload An Image")
   if file:
       b=file.getvalue()
       a=np.frombuffer(b,np.uint8)
       img=cv2.imdecode(a,cv2.IMREAD_COLOR)
       face=facemodel.detectMultiScale(img)
       for(x,y,l,w) in face:
           cv2.imwrite("temp.jpg",img[y:y+w,x:x+l])
           face_img=load_img("temp.jpg",target_size=(150,150,3))
           face_img=img_to_array(face_img)
           face_img=np.expand_dims(face_img,axis=0)
           pred=maskmodel.predict(face_img)[0][0]
           if(pred==1):
               cv2.rectangle(img, (x,y), (x+l,y+w), (0,0,255),8) 
           else:    
               cv2.rectangle(img, (x,y), (x+l,y+w), (0,255,0),8) 
       st.image(img,channels='BGR')
elif(choice=="WEBCAM"):
   k=st.text_input("ENTER 0 FOR PRIMARY CAMERA OR 1 FOR THE SECONDARY CAMERA")
   btn=st.button("Start Camera")
   if btn:
       window=st.empty()
       k=int(k)
       vid=cv2.VideoCapture(k)
       btn2=st.button("Stop Camera")
       if(btn2):
           vid.release()
           st.experimental_rerun()
       while(vid.isOpened()):
           flag,frame=vid.read()
           if(flag):
               face=facemodel.detectMultiScale(frame)
               for(x,y,l,w) in face:
                   cv2.imwrite("temp.jpg",frame[y:y+w,x:x+l])
                   face_img=load_img("temp.jpg",target_size=(150,150,3))
                   face_img=img_to_array(face_img)
                   face_img=np.expand_dims(face_img,axis=0)
                   pred=maskmodel.predict(face_img)[0][0]
                   if(pred==1):
                       cv2.rectangle(frame, (x,y), (x+l,y+w), (0,0,255),8) 
                   else:    
                       cv2.rectangle(frame, (x,y), (x+l,y+w), (0,255,0),8) 
               window.image(frame,channels='BGR')
if(choice=="URL"):
   k=st.text_input("ENTER URL FOR THE VIDEO")
   btn=st.button("Start Camera")
   if btn:
       window=st.empty()
       vid=cv2.VideoCapture(k)
       btn2=st.button("Stop Camera")
       if(btn2):
           vid.release()
           st.experimental_rerun()
       while(vid.isOpened()):
           flag,frame=vid.read()
           if(flag):
               face=facemodel.detectMultiScale(frame)
               for(x,y,l,w) in face:
                   cv2.imwrite("temp.jpg",frame[y:y+w,x:x+l])
                   face_img=load_img("temp.jpg",target_size=(150,150,3))
                   face_img=img_to_array(face_img)
                   face_img=np.expand_dims(face_img,axis=0)
                   pred=maskmodel.predict(face_img)[0][0]
                   if(pred==1):
                       cv2.rectangle(frame, (x,y), (x+l,y+w), (0,0,255),8) 
                   else:    
                       cv2.rectangle(frame, (x,y), (x+l,y+w), (0,255,0),8) 
               window.image(frame,channels='BGR')


      