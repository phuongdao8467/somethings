using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace CarRentalv1
{
    public partial class MaintenanceOperator : Form
    {
        private VehicleRentalManagement _data = null;
        public MaintenanceOperator(VehicleRentalManagement vehicleRentalManagementModel)
        {
            this._data = vehicleRentalManagementModel;
            InitializeComponent();
        }

        private void button2_Click(object sender, EventArgs e)
        {
            try
            {
                int vehicleId = int.Parse(VehicleIDText.Text);
                object o = _data.GetVehicleByID(vehicleId);
                if (o != null)
                {
                    if ((o.GetType()).Equals(typeof(Car)))
                    {
                    
                        ViewServiceHistory viewServiceHistory = new ViewServiceHistory(((Car)o).History.PrintServiceHistory());
                        viewServiceHistory.Show();
                        return;
                    }
                    else if ((o.GetType()).Equals(typeof(Truck)))
                    {
                        ViewServiceHistory viewServiceHistory = new ViewServiceHistory(((Car)o).History.PrintServiceHistory());
                        viewServiceHistory.Show();
                        return; 
                    }
                }

            }
            catch
            {
                MessageBox.Show("Vehicle doesn't exist ");
            }
        }

        private void MaintenanceOperator_Load(object sender, EventArgs e)
        {

        }

        private void textBox2_TextChanged(object sender, EventArgs e)
        {

        }

        private void button3_Click(object sender, EventArgs e)
        {
            try
            {
                string op = Operator.Text;
                int vehicleId = int.Parse(VehicleIDText.Text);
                int index1 = int.Parse(Index1.Text);
                int index2 = int.Parse(Index2.Text);
                if (op == "<")
                {
                    Result.Text = _data.PerformSmallerOperator(vehicleId, index1, index2).ToString();
                }
                else if  (op == "-"){
                    Result.Text = _data.PerformSubtractionOperator(vehicleId, index1, index2).ToString();
                }
                else
                {
                    MessageBox.Show("Wrong operator, please type > or -");
                }
            }
            catch
            {
                MessageBox.Show("Wrong input");
            }
        }
    }
}
