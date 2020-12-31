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
    public partial class ViewAllRents : Form
    {
        private VehicleRentalManagement _data = null;
        public ViewAllRents(VehicleRentalManagement vehicleRentalManagementModel)
        {
            this._data = vehicleRentalManagementModel;
            InitializeComponent();
            RentListBox.Text = _data.GetListOfRentInfo();
        }
        private void RentListBox_TextChanged(object sender, EventArgs e)
        {

        }
    }
}
