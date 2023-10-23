
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace HijazCranes.Models
{
    public class CustomerContact
    {
        public int Id { get; set; }
        [Phone]
        public string Contact { get; set; }
        public int Customer_Id { get; set; }
        public EContactType ContactType { get; set; }
        public bool Default { get; set; }
        [ForeignKey("Customer_Id")]
        public Customer Customer { get; set; }
        public enum EContactType
        {
            MobileNumber,
            LandLine
        }
    }
}