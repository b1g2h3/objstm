import Domu from "./components/lib/Domu";
import AllCategories from "./components/category/AllCategories";
import ShowCategory from "./components/category/ShowCategory";
import createCategory from "./components/category/CreateCategory";
import editCategory from "./components/category/editCategory";
import createProduct from "./components/product/createProduct";
import AddOrder from "./components/order/addOrder";
import EditOrder from "./components/order/EditOrder";
import ShowOrder from "./components/order/ShowOrder";
import IndexOrder from "./components/order/indexOrder";
import Login from "./components/auth/login";
import Register from "./components/auth/register";
import Logout from "./components/auth/Logout";
import AddInvoice from "./components/invoice/AddInvoice";
import Settings from "./components/settings/Settings";
import ChangePassword from "./components/settings/ChangePassword";
import ChangeContact from "./components/settings/ChangeContact";
import ChangeInvoice from "./components/invoice/ChangeInvoice";
import KeStazeni from "./components/lib/kestazeni";
import Kontakt from "./components/contact/sendEmail";
import admin from "./components/admin/admin";
import showUsers from "./components/admin/user/showUsers";
import showAllOrders from "./components/admin/order/showAllOrders";

export const routes = [
    {
        name: "home",
        path: "/",
        component: Domu
    },
    {
        name: "zbozi",
        path: "/zbozi",
        component: AllCategories,
        props: true,
        children: [
            {
                name: "category_show",
                path: ":id",
                component: ShowCategory,
                props: true
            }
        ]
    },
    {
        name: "kontakt",
        path: "/kontakt",
        component: Kontakt
    },
    {
        name: "login",
        path: "/prihlasit-se",
        component: Login,
        props: true
    },
    {
        name: "register",
        path: "/registrovat",
        component: Register,
        props: true
    },
    {
        name: "logout",
        path: "/logout",
        component: Logout
    },
    {
        name: "kestazeni",
        path: "/ke-stazeni",
        component: KeStazeni
    },
    {
        name: "objednat",
        path: "/objednat-zbozi",
        component: AddOrder,
        meta: { requiresAuth: true, requiredInvoice: true }
    },
    {
        name: "Orders",
        path: "/objednavky",
        component: IndexOrder,
        meta: {
            requiresAuth: true,
            requiredInvoice: true
        },
        children: [
            {
                name: "ShowOrder",
                path: ":id",
                component: ShowOrder,
                props: true
            },
            {
                name: "EditOrder",
                path: ":id/upravit",
                component: EditOrder,
                props: true
            }
        ]
    },
    {
        name: "settings",
        path: "/nastaveni",
        component: Settings,
        meta: {
            requiresAuth: true,
            requiredInvoice: true
        },
        children: [
            {
                name: "ChangePassword",
                path: "zmenit-heslo",
                component: ChangePassword
            },
            {
                name: "ChangeContact",
                path: "zmena-kontaktni-udaju",
                component: ChangeContact
            }
        ]
    },
    {
        name: "invoice",
        path: "/fakturacni-udaje",
        component: AddInvoice
    },
    {
        name: "admin",
        path: "/administrator",
        component: admin,
        meta: {
            requiresAuth: true,
            requiredInvoice: true
        },
        children: [
            {
                name: "createCategory",
                path: "vytvorit-kategorii",
                component: createCategory
            },
            {
                name: "editCategory",
                path: "upravit-kategorii/:id",
                component: editCategory,
                props: true
            },
            {
                name: "createProduct",
                path: "vytvorit-produkt",
                component: createProduct
            },
            {
                name: "showAllOrders",
                path: "prehled-objednavek",
                component: showAllOrders
            },
            {
                name: "showUsers",
                path: "prehled-zakazniku",
                component: showUsers
            }
        ]
    }
];
