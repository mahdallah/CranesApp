namespace HijazCranes.Migrations
{
    using System;
    using System.Data.Entity.Migrations;
    
    public partial class AddingCustomerContactModel : DbMigration
    {
        public override void Up()
        {
            CreateTable(
                "dbo.CustomerContacts",
                c => new
                    {
                        Id = c.Int(nullable: false, identity: true),
                        Contact = c.String(),
                        Customer_Id = c.Int(nullable: false),
                        ContactType = c.Int(nullable: false),
                        Default = c.Boolean(nullable: false),
                    })
                .PrimaryKey(t => t.Id)
                .ForeignKey("dbo.Customers", t => t.Customer_Id, cascadeDelete: true)
                .Index(t => t.Customer_Id);
            
        }
        
        public override void Down()
        {
            DropForeignKey("dbo.CustomerContacts", "Customer_Id", "dbo.Customers");
            DropIndex("dbo.CustomerContacts", new[] { "Customer_Id" });
            DropTable("dbo.CustomerContacts");
        }
    }
}
