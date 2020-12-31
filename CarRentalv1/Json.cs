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
    public partial class Json : Form
    {
        private VehicleRentalManagement _data = null;
        public Json(VehicleRentalManagement vehicleRentalManagementModel)
        {
            this._data = vehicleRentalManagementModel;
            InitializeComponent();
        }


        private void label1_Click(object sender, EventArgs e)
        {

        }

        private void button1_Click(object sender, EventArgs e)
        {
            AddAndSave form = new AddAndSave(_data);
            form.ShowDialog();

        }

        private void button2_Click(object sender, EventArgs e)
        {
            DisplayServiceHistory form = new DisplayServiceHistory();
            form.ShowDialog();
            
        }

        private void Exit_Click(object sender, EventArgs e)
        {
            this.Close();
        }
    }
}
