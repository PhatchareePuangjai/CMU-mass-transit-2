#!/usr/bin/env python3
#!/usr/bin/pip3

import json
import paho.mqtt.client as mqtt
from datetime import datetime
import time
# import geopy.distance

#mondoDB
from pymongo import MongoClient

    ####################
    
    #Callbacks
def on_connect (client, userdata, flags, rc):
    
    print("Connected with code :" + str(rc))
    client.subscribe("cmutransit/busonservice")
    
    ####################
def on_message(client, userdata, message):
    
    data  = json.loads(message.payload)
    
    # accuracy
    # bus
    # driver
    # geton
    # lat
    # lng
    # passenger
    # route
    # speed
    # timestamp
    # v

    dataSelect = []
    dataSelect.append({  
        'bus': data['bus'],
        'driver': data['driver'],
        'lat':  data['lat'],
        'lng':  data['lng'],
        'passenger':  data['passenger'],
        'route':  data['route'],
        'speed':  data['speed'],
        'timestamp':  data['timestamp'],
        'lat':  data['lat']
         
    })
  
    # print(dataSelect[0])   
    #insert MondoDB
    insertDatabaseMongo(dataSelect[0])
    # busStation(dataSelect[0])
    
    ####################

# def loopData():
#     
#     #create connection
#     con = MongoClient("localhost", 27017)
#     #create database company
#     db = con.get_database("transitCarCMU")
#     #create collection
#     table = db.testTransit
#     
#     data_load = table.find() 
#     for i in data_load:
#         print(i)

    ####################
    
def insertDatabaseMongo(data):
    
    #create connection
    con = MongoClient("localhost", 27017)
   
    #create database company
    db = con['timesyscmu']
    #create collection
    table = db.transit
        
    time = datetime.strptime(data['timestamp'] , '%Y-%m-%dT%H:%M:%S.%f')

    #เวลามันไม่ได้มี 00.0 เสมอไปทุกวินาที เลยไม่สามารถทำเเบบนี้ได้
    # time_sec = data['timestamp'].split('T')
    # time_sec = time_sec[1].split(':')
    # print(time_sec[2 ])
    # print(time.second)
    
    #เช็คเวลาเพื่อเก็บ
    if(time.hour <= 22 and time.hour >= 7):
        #เช็คสาย ว่าเป็นสาย 1 หรือสาย 3 ไหม
        if(data['route'] == 1 or data['route'] == 3):    
            #Insert data
            table.insert(data)
            print(data)
     
            
    ####################
    
def startClient(data):
    
    client = mqtt.Client()
    client.on_connect = on_connect
    client.on_message = on_message
    
    client.connect("202.28.244.147")
    client.username_pw_set("cmu_opd","morchor@4.0now")
    
    # ใช้วิธี loop ตลอดเอาเเต่เวลาเก็บข้างบน เก็บตามเวลาจริงๆ
    # อย่าใช้ใน service จะไม่มีทางหยุดลูป
    # loop forever
    # client.loop_forever()
    
    
    client.loop_start() #start loop to process received messages
    time.sleep(2)
    client.disconnect() #disconnect
    client.loop_stop() #stop loop


    # stop program 
    # keyBorad = 0
    # while(keyBorad != 1):
    #     client.loop_start()
    #     keyBorad = int(input())
    #     
    # client.loop_stop()
        
    ####################

def main():
    data = []
    startClient(data)
    # loopData()
    
    ####################
    
if __name__ == '__main__':
    main() 