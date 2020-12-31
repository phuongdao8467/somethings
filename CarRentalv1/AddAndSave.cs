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
    public partial class AddAndSave : Form
    {
        private VehicleRentalManagement _data = null;
        public AddAndSave(VehicleRentalManagement vehicleRentalManagementModel)
        {
            this._data = vehicleRentalManagementModel;
            InitializeComponent();
        }

        private void label1_Click(object sender, EventArgs e)
        {

        }

        private void label4_Click(object sender, EventArgs e)
        {

        }

        private void button1_Click(object sender, EventArgs e)
        {
            try
            {
                JsonManage json = new JsonManage();
                _data.SaveServiceOfVehicle( Int32.Parse(CarID.Text));
                MessageBox.Show("History has been stored, the path is bin/Debug/" + Int32.Parse(CarID.Text) + ".json");
            }
            catch
            {
                MessageBox.Show("Error Input!", "Error", MessageBoxButtons.OK, MessageBoxIcon.Error);
            }



        }

        private void button1_Click_1(object sender, EventArgs e)
        {
            this.Close();
        }

        private void Date_TextChanged(object sender, EventArgs e)
        {

        }

        private void textBox1_TextChanged(object sender, EventArgs e)
        {

        }

        private void y_TextChanged(object sender, EventArgs e)
        {

        }

        private void AddAndSave_Load(object sender, EventArgs e)
        {

        }
    }
}
