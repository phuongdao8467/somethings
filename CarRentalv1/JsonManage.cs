using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using Newtonsoft.Json;
using System.IO;

namespace CarRentalv1
{
    class JsonManage
    {
        public JsonManage() { }
        public void SaveServiceOfVehicle(ServiceHistory serviceHistory,int vehicleId)
        {
            //Save record to Json file
            foreach(Record r in serviceHistory.PrintServiceHistory())
            {
                /*r.CarID = carID*/;
                string saveRecord = JsonConvert.SerializeObject(r);
                File.AppendAllText(vehicleId + ".json", saveRecord);
                File.AppendAllText(vehicleId + ".json", "\n");

            }
        }
        public string DisplayServiceOfVehicle(int vehicleId)
        {
            //Display record to screen
            try
            {
                string saveRecord = File.ReadAllText(vehicleId + ".json");
                return saveRecord;
            }
            catch
            {
                return "Vehicle doesn't exist";
            }
        }

    }
}
