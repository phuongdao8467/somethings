using System;
using System.Collections.Generic;
using System.Text;

namespace CarRentalv1
{
    public interface IBookAndRent
    {
        bool BookAndRent(string customerName, string customerSSN, int vehicleId, string vehicleType, float price, float deposit, DateTime timeRent, DateTime timeExpire);
        bool BookAndRent(string customerName, string customerSSN, int vehicleId, string vehicleType, float price, float deposit);
        bool BookAndRent(string customerName, string customerSSN, int vehicleId, string vehicleType);
        bool BookAndRent();
    }
    public class VehicleRentalManagement : IBookAndRent
    {

        public List<Fleet> ListOfFleet = new List<Fleet>();
        private List<Rent> _listOfRents = new List<Rent>();

        public Fleet GetFleetByID(int id)
        {
            foreach (Fleet i in ListOfFleet)
            {
                if (i.ID == id) return i; 
            }
            return null; 
        }

        public object GetVehicleByID(int id)
        {
            foreach (Fleet i in ListOfFleet)
            {
                object vehicle = i.PrintVehicleInfo(id);
                if (vehicle != null) return vehicle;
            }
            return null;
        }

        public VehicleRentalManagement()
        {
            this.ListOfFleet.Add(new Fleet());
            Car newCar = new Car(100, "qwewqe", Fleet.MaxVehicleID);
            Car newCar1 = new Car(112, "qwewqe", Fleet.MaxVehicleID++);
            Car newCar2 = new Car(113, "qwewqe", Fleet.MaxVehicleID++);
            this.ListOfFleet[0].AddCarIntoVehicleFleet(newCar);
            this.ListOfFleet[0].AddCarIntoVehicleFleet(newCar1);
            this.ListOfFleet[0].AddCarIntoVehicleFleet(newCar2);
            this.ListOfFleet.Add(new Fleet());
            this.ListOfFleet[1].AddCarIntoVehicleFleet(new Car(113, "qHELoe", Fleet.MaxVehicleID++));
            this.ListOfFleet.Add(new Fleet());
            
        }

        public void AddNewFleet()
        {
            ListOfFleet.Add(new Fleet());
        }

        private void _addNewRent(Rent rent)
        {
            _listOfRents.Add(rent);
        }

        public bool BookAndRent(string customerName, string customerSSN, int vehicleId, string vehicleType, float price, float deposit,DateTime timeRent, DateTime timeExpire)
        {
            if (vehicleType == "Car")
            {
                Car foundCar = null;
                foreach (Fleet i in ListOfFleet)
                {
                    if ((foundCar = (Car)(i.CheckRentStatus(vehicleId))) != null)
                    {
                        foundCar.IsRented = true;
                       _addNewRent(new Rent(customerName , customerSSN,vehicleId, vehicleType,price,deposit,timeRent,timeExpire));
                        return true;
                    }
                }
                return false;
            }
            else if (vehicleType == "Truck")
            {
                Truck foundTruck = null;
                foreach (Fleet i in ListOfFleet)
                {
                    if ((foundTruck = (Truck)(i.CheckRentStatus(vehicleId))) != null)
                    {
                        foundTruck.IsRented = true;
                        _addNewRent(new Rent(customerName, customerSSN, vehicleId, vehicleType, price, deposit,  timeRent, timeExpire));
                        return true;
                    }
                }
                return false;
            }
            return false ; 
        }

        public bool BookAndRent()
        {
            _addNewRent(new Rent());
            return true; 
        }

        public bool BookAndRent(string customerName, string customerSSN, int vehicleId, string vehicleType, float price, float deposit )
        {
            if (vehicleType == "Car")
            {
                Car foundCar = null;
                foreach (Fleet i in ListOfFleet)
                {
                    if ((foundCar = (Car)(i.CheckRentStatus(vehicleId))) != null)
                    {
                        foundCar.IsRented = true;
                        _addNewRent(new Rent(customerName, customerSSN, vehicleId, vehicleType, price, deposit));
                        return true;
                    }
                }
                return false;
            }
            else if (vehicleType == "Truck")
            {
                Truck foundTruck = null;
                foreach (Fleet i in ListOfFleet)
                {
                    if ((foundTruck = (Truck)(i.CheckRentStatus(vehicleId))) != null)
                    {
                        foundTruck.IsRented = true;
                        _addNewRent(new Rent(customerName, customerSSN, vehicleId, vehicleType, price, deposit));
                        return true;
                    }
                }
                return false;
            }
            return false;
        }

        public bool BookAndRent(string customerName, string customerSSN, int vehicleId, string vehicleType)
        {
            if (vehicleType == "Car")
            {
                Car foundCar = null;
                foreach (Fleet i in ListOfFleet)
                {
                    if ((foundCar = (Car)(i.CheckRentStatus(vehicleId))) != null)
                    {
                        foundCar.IsRented = true;
                        _addNewRent(new Rent(customerName, customerSSN, vehicleId, vehicleType));
                        return true;
                    }
                }
                return false;
            }
            else if (vehicleType == "Truck")
            {
                Truck foundTruck = null;
                foreach (Fleet i in ListOfFleet)
                {
                    if ((foundTruck = (Truck)(i.CheckRentStatus(vehicleId))) != null)
                    {
                        foundTruck.IsRented = true;
                        _addNewRent(new Rent(customerName, customerSSN, vehicleId, vehicleType));
                        return true;
                    }
                }
                return false;
            }
            return false;
        }

        public bool UpdateRent(int rentId,string customerName, string customerSSN, int vehicleId, string vehicleType, float price, float deposit, DateTime timeRent, DateTime timeExpire)
        {
            // Find a rent

            Rent rent = GetRentByRentId(rentId);
            if (rent != null)
            {
                //if (rent.VehicleID != vehicleId)
                //{
                //    object oldVehicle = GetVehicleByID(rent.VehicleID);
                //    object newVehicle = GetVehicleByID(vehicleId);

                //}
                rent = new Rent(customerName, customerSSN, vehicleId, vehicleType, price, deposit, timeRent, timeExpire);


                return true; 
            }
            return false; 
        }


        public void AddNewVehicle(int fleetId, string plateCode, String type, int mileAge)
        {
            // Find fleet by fleet id 
            foreach (Fleet i in ListOfFleet)
            {
                if (i.ID == fleetId)
                {
                    // Create new vehicle 

                    // Add new vehicle into fleet 
                    if (type == "Car")
                    {
                        Car newCar = new Car(mileAge, plateCode, Fleet.MaxID);
                        i.AddCarIntoVehicleFleet(newCar);
                    }

                    break;
                }
            }

        }


        public void ServiceFleet(int fleetId, string type, string garageName, float price)
        {
            foreach (Fleet i in ListOfFleet)
            {
                if (i.ID == fleetId)
                {
                    i.RecordServiceForFleet(type, garageName, price);
                    break;
                }
            }
        }

        public void ServiceVehicle(int vehicleId, string type, string garageName, float price)
        {
            foreach (Fleet i in ListOfFleet)
            {
                i.RecordServiceForVehicleId(vehicleId, type, garageName, price);
            }
        }

        public Rent GetRentByRentId(int id)
        {
            foreach (Rent i in _listOfRents)
            {
                if (i.RentID == id) return i; 
            }
            return null;
        }


        // Rent
        public bool DeleteRent(int rentId)
        {
            // Find a rent
            Rent rent = GetRentByRentId(rentId);
            object o = GetVehicleByID(rent.VehicleID);
            if ((o.GetType()).Equals(typeof(Car)))
            {
                ((Car)o).IsRented = false;
                return _listOfRents.Remove(rent);
            }
            else if ((o.GetType()).Equals(typeof(Truck)))
            {
                ((Truck)o).IsRented = false;
                return _listOfRents.Remove(rent);
            }
            else return false; 
        }
        public string GetListOfRentInfo()
        {
            string info = "";
            foreach (Rent i in _listOfRents)
            {
                info += i.GetRentInfo();
            }
            return info; 
        }
        public float PerformSubtractionOperator(int vehicleId, int index1, int index2)
        {
            object o = GetVehicleByID(vehicleId);
            if ((o.GetType()).Equals(typeof(Car)) && ((Car)o).ID == vehicleId)
            {
                return ((Car)o).SuctractRecord(index1, index2);
            }
            else if ((o.GetType()).Equals(typeof(Truck)) && ((Truck)o).ID == vehicleId)
            {
                return ((Truck)o).SuctractRecord(index1, index2);
            }
            else
            {
                throw new System.Exception();
            }

        }
        public bool PerformSmallerOperator(int vehicleId, int index1, int index2)
        {
            object o = GetVehicleByID(vehicleId);
            if ((o.GetType()).Equals(typeof(Car)) && ((Car)o).ID == vehicleId)
            {
                return ((Car)o).CompareLesserThanRecord(index1, index2);
            }
            else if ((o.GetType()).Equals(typeof(Truck)) && ((Truck)o).ID == vehicleId)
            {
                return ((Truck)o).CompareLesserThanRecord(index1, index2);
            }
            else
            {
                throw new System.Exception();
            }
        }

        public bool SaveServiceOfVehicle(int vehicleId)
        {
            JsonManage jsonManage = new JsonManage();

            object o = GetVehicleByID(vehicleId);
            if ((o.GetType()).Equals(typeof(Car)))
            {
                jsonManage.SaveServiceOfVehicle(((Car)o).History, vehicleId);
                return true;
            }
            else if ((o.GetType()).Equals(typeof(Truck)))
            {
                jsonManage.SaveServiceOfVehicle(((Truck)o).History, vehicleId);
                return true;
            }
            return false;
        }
        public string DisplayServiceOfVehicle(int vehicleId)
        {
            JsonManage jsonManage = new JsonManage();
            return jsonManage.DisplayServiceOfVehicle(vehicleId);
        }

    }
}